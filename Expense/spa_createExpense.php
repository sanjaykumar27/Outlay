<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_34="local" id="CreateExpense" components="{dmxFormatter:{},dmxNotifications:{},dmxBootstrap4Toasts:{},dmxAutocomplete:{},dmxDropzone:{}}" -->
<dmx-value id="varCategoryID"></dmx-value>
<dmx-serverconnect id="scInvoiceID" url="dmxConnect/api/Expense/getMaxInvoiceID.php" noload="noload"></dmx-serverconnect>
<dmx-datetime id="varDateTime"></dmx-datetime>
<dmx-notifications id="notifies1" offset-x="30" offset-y="30" closable newest-on-top></dmx-notifications>
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
			dmx-on:success="CreateExpense.reset();scGetExpense.load();varCounter.setValue(1);scInvoiceID.load();notifies1.success(&quot;Expense Created Succesfully&quot;)">
			<div class="card-body p-6 border-dark-75 rounded border" is="dmx-repeat" id="repeatItems" dmx-bind:repeat="varCounter.value">
				<div class="row mb-2 py-1 row" dmx-class:bg-light="$index % 2 == 0 && scGetTheme.data.getTheme.main_theme !='Dark'">
					<!-- <div class="col-lg-3">
						<div class="form-group">
							<label>Category:</label>
							<select class="form-control " name="CategoryID" dmx-bind:options="scCategories.data.getCategories" optiontext="category_name" optionvalue="id" dmx-on:changed="scItemLists.load({categoryid: value})">
								<option selected disabled value="">Categories</option>
							</select>
						</div>
					</div> -->
					<div class="col-lg-1 col-6">
						<div class="form-group">
							<label>Invoice</label>
							<input type="number" step="0.1" name="InvoiceNumber[]" dmx-bind:value="scInvoiceID.data.getMaxInvoiceID.InvoiceID+1" class="form-control" />
						</div>
					</div>
					<div class="col-lg-2 col-6">
						<div class="form-group">
							<label>New Item</label>
							<input type="text" class="form-control " autocomplete="off" name="NewItem[]">
						</div>
					</div>
					<div class="col-lg-2 col-6">
						<div class="form-group">
							<label>Search Item:</label>
							<input class="form-control " name="ItemID[]" is="dmx-autocomplete" dmx-bind:data="scItemLists.data.getItems" optiontext="subcategory_name" optionvalue="id">
							<!-- <select class="form-control " name="ItemID[]" style="width: 100% !important;" dmx-bind:options="scItemLists.data.getItems" optiontext="subcategory_name" optionvalue="id">
								<option value="" selected>Select Item</option>
							</select> -->
						</div>
					</div>
					<div class="col-lg-1 col-6">
						<div class="form-group">
							<label>QTY:</label>
							<input type="number" value="1" step="0.1" name="Quantity[]" class="form-control" placeholder="Quantity" />
						</div>
					</div>
					<div class="col-lg-2 col-6">
						<div class="form-group">
							<label>Unit:</label>
							<select class="form-control " name="UnitID[]" style="width: 100% !important;" dmx-bind:options="scUnits.data.queryUnits" optiontext="UnitName" optionvalue="UnitID">
								<option value="" selected disabled>Select</option>
							</select>
						</div>
					</div>
					<div class="col-lg-2 col-6">
						<div class="form-group">
							<label>Amount:</label>
							<input type="number" id="Price" step="0.1" name="Amount[]" class="form-control" placeholder="Amount" />
						</div>
					</div>
					<div class="col-lg-2 col-6">
						<div class="form-group">
							<label>Date:</label>
							<input type="date" name="PurchaseDate[]" class="form-control" placeholder="Purchase Date" dmx-bind:value="varDateTime.datetime.formatDate(&quot;yyyy-MM-dd&quot;)" />
						</div>
					</div>
					<div class="col-lg-2 col-6">
						<div class="form-group">
							<label>Account</label>
							<select class="form-control " name="AccountID[]" dmx-bind:options="scAccountList.data.queryAccountList" optiontext="bank_name + ' ' + account_number" optionvalue="id" value="2">
								<option selected disabled value="">Account</option>
							</select>
						</div>
					</div>
					<div class="col-lg-2 col-6">
						<div class="form-group">
							<label>Payment Type:</label>
							<select class="form-control " name="PaymentMethod[]" dmx-bind:options="scPaymentMethods.data.queryPaymentMethods" optiontext="PaymentType" optionvalue="PaymentID" value="6">
								<option selected disabled value="">Payment Method</option>
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="form-group">
							<label>Invoice Name:</label>
							<input type="text" name="InvoiceName[]" class="form-control" placeholder="Invoice Name" />
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="form-group">
							<label>Remark:</label>
							<textarea name="Remark[]" rows="1" class="form-control" placeholder="Enter full name"></textarea>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label>Receipt</label>
							<input is="dmx-dropzone" id="targetFile" type="file" name="target_photo[]">
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col ">
					<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAddItem" dmx-on:click="varCategoryID.setValue(repeatItem.CategoryID.value)">Add Item</button>
				</div>
				<div class="col  text-right">
					<button class="btn btn-icon btn-light-success" dmx-on:click="varCounter.setValue(varCounter.value + 1)">
						<i class="fa fa-plus"></i>
					</button>
					<button class="btn btn-icon btn-light-danger" dmx-show="varCounter.value != 1" dmx-on:click="varCounter.setValue(varCounter.value - 1)">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col text-center h4 font-weight-bold">Total Amount: {{repeatItems.items.sum(`Price.value`)}}</div>
			</div>

			<div class="card-footer text-center border-0">
				<button type="submit" class="btn btn-primary mr-2 btn-lg" dmx-bind:disabled="state.executing">Submit <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span>
				</button>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="modalAddItem" is="dmx-bs4-modal" tabindex="-1" role="dialog" nocloseonclick="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form is="dmx-serverconnect-form" id="FormAddItem" action="dmxConnect/api/Master/createItem.php" method="post"
				dmx-on:success="notifies1.success('Item added succesfully');scItemLists.load({categoryid: varCategoryID.value});modalAddItem.hide();modalAddItem.FormAddItem.reset();varCategoryID.setValue('')">
				<div class="modal-header">
					<h5 class="modal-title">Add Item</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Category:</label>
						<select class="form-control " name="category_id" dmx-bind:options="scCategories.data.getCategories" optiontext="category_name" optionvalue="id"
							dmx-bind:value="scCategories.data.getCategories.where(`id`, varCategoryID.value, '==').values(`id`)">
							<option selected disabled value="">Categories</option>
						</select>
					</div>
					<div class="form-group">
						<label>Item:</label>
						<input type="text" name="subcategory_name" class="form-control " required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" dmx-on:click="varCategoryID.setValue('')">Close</button>
					<button type="submit" class="btn btn-primary" dmx-bind:disabled="state.executing">Save changes <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>