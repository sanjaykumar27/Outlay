<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_34="local" id="CreateExpense" components="{dmxFormatter:{},dmxNotifications:{},dmxBootstrap4Toasts:{}}" -->

<dmx-serverconnect id="scInvoiceID" url="dmxConnect/api/Expense/getMaxInvoiceID.php"></dmx-serverconnect>
<dmx-datetime id="varDateTime"></dmx-datetime>

<dmx-notifications id="notifies1" offset-x="30" offset-y="30" closable newest-on-top></dmx-notifications>
<dmx-serverconnect id="scItemLists" url="dmxConnect/api/Common/getItems.php" dmx-param:categoryid=""></dmx-serverconnect>
<dmx-serverconnect id="scAccountList" url="dmxConnect/api/Common/getAccountList.php"></dmx-serverconnect>
<dmx-serverconnect id="scPaymentMethods" url="dmxConnect/api/Common/getPaymentMethods.php"></dmx-serverconnect>
<dmx-serverconnect id="scUnits" url="dmxConnect/api/Common/getUnits.php"></dmx-serverconnect>
<dmx-serverconnect id="scCategories" url="dmxConnect/api/Common/getItemCategory.php"></dmx-serverconnect>
<dmx-value id="varCounter" dmx-bind:value="1"></dmx-value>
<div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
	<!--begin::Info-->
	<div class="d-flex align-items-center flex-wrap mr-1">
		<!--begin::Page Heading-->
		<div class="d-flex align-items-baseline mr-5">
			<!--begin::Page Title-->
			<h1 class="text-dark my-2 mr-5 font-weight-light">
				Create Expense </h1>
			<!--end::Page Title-->
		</div>
		<!--end::Page Heading-->
	</div>
	<!--end::Info-->

	<!--begin::Toolbar-->
	<div class="d-flex align-items-center">
		<!--begin::Actions-->
		<a href="./expense/list" class="btn btn-primary font-weight-bold btn-sm">
			<i class="flaticon-plus"></i>
			Expense List
		</a>
	</div>

	<!--end::Toolbar-->
</div>
<div class="d-flex flex-column-fluid pt-2">
	<div class="container-fluid">
		<form class="form" method="post" is="dmx-serverconnect-form" id="CreateExpense" action="dmxConnect/api/Expense/createExpense.php"
			dmx-on:success="CreateExpense.reset();scGetExpense.load({});varCounter.setValue(1);scInvoiceID.load();notifies1.success(&quot;Expense Created Succesfully&quot;">
			<div class="card-body">
				<h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Invoice Info:</h3>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label>Invoice No:</label>
							<input type="number" name="InvoiceNumber" dmx-bind:value="scInvoiceID.data.getMaxInvoiceID.InvoiceID+1" class="form-control form-control-solid" />
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label>Invoice Name:</label>
							<input type="text" name="InvoiceName" class="form-control form-control-solid" placeholder="Invoice Name" />
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label>Date:</label>
							<input type="date" name="PurchaseDate" class="form-control form-control-solid" placeholder="Purchase Date" dmx-bind:value="varDateTime.datetime.formatDate(&quot;yyyy-MM-dd&quot;)" />
						</div>
					</div>
				</div>
				<hr>
				<h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Payment Info:</h3>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label>Account</label>
							<select class="form-control" name="AccountID" dmx-bind:options="scAccountList.data.queryAccountList" optiontext="bank_name + ' ' + account_number" optionvalue="id" value="2">
								<option selected disabled value="">Account</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label>Payment Type:</label>
							<select class="form-control" name="PaymentMethod" dmx-bind:options="scPaymentMethods.data.queryPaymentMethods" optiontext="PaymentType" optionvalue="PaymentID" value="6">
								<option selected disabled value="">Payment Method</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label>Remark:</label>
							<input type="text" name="Remark" class="form-control form-control-solid" placeholder="Enter full name" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label>Upload Receipt</label>
							<input is="dmx-dropzone" id="targetFile" type="file" name="target_photo" thumbs="false" data-msg-required="">
						</div>
					</div>
				</div>
				<hr>
				<h3 class="font-size-lg text-dark font-weight-bold mb-6">3. Item Info:</h3>

				<div class="row" is="dmx-repeat" id="repeatItem" dmx-bind:repeat="varCounter.value">
					<!-- <div class="col-lg-3">
						<div class="form-group">
							<label>Category:</label>
							<select class="form-control" name="CategoryID" dmx-bind:options="scCategories.data.getCategories" optiontext="category_name" optionvalue="id" dmx-on:changed="scItemLists.load({categoryid: value})">
								<option selected disabled value="">Categories</option>
							</select>
						</div>
					</div> -->
					<div class="col-lg-4">
						<div class="form-group">
							<label>Item:</label>
							<select class="form-control" name="ItemID[]" style="width: 100% !important;" dmx-bind:options="scItemLists.data.getItems" optiontext="subcategory_name" optionvalue="id">
								<option value="" selected>Select Item</option>
							</select>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label>Quantity:</label>
							<input type="number" value="1" name="Quantity[]" class="form-control form-control-solid" placeholder="Quantity" />
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label>Unit:</label>
							<select class="form-control" name="UnitID[]" style="width: 100% !important;" dmx-bind:options="scUnits.data.queryUnits" optiontext="UnitName" optionvalue="UnitID">
								<option value="" selected>Select Item</option>
							</select>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label>Amount:</label>
							<input type="number" name="Amount[]" class="form-control form-control-solid" placeholder="Amount" />
						</div>
					</div>

				</div>
				<div class="row text-right">
					<div class="col">
						<button class="btn btn-icon btn-light-success" dmx-on:click="varCounter.setValue(varCounter.value + 1)">
							<i class="fa fa-plus"></i>
						</button>
						<button class="btn btn-icon btn-light-danger" dmx-show="varCounter.value != 1" dmx-on:click="varCounter.setValue(varCounter.value - 1)">
							<i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
			</div>
			<div class="card-footer text-center">
				<button type="submit" class="btn btn-primary mr-2 btn-lg" dmx-bind:disabled="state.executing">Submit <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span>
				</button>
			</div>
		</form>
	</div>
</div>