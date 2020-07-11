<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_33="cdn" id="ExpenseList" components="{dmxStateManagement:{},dmxBootstrap4Collapse:{},dmxFormatter:{},dmxBootstrap4Tooltips:{},dmxBootstrap4PagingGenerator:{},dmxBootstrap4Modal:{},dmxPreloader:{},dmxBootstrap4Alert:{}}" -->

<dmx-preloader id="preloader1" preview="true" spinner="circle" color="#d482b3" dmx-show="scExpenseList.state.executing || scGetItems.state.executing || scCategories.state.executing" bgcolor="#000000e3" size="80"></dmx-preloader>

<dmx-value id="varExpenseID"></dmx-value>

<dmx-value id="varPreviousLast" dmx-bind:value="'<?php echo date('Y-m-d', mktime(0, 0, 0, date('m'), 0)) ?>'"></dmx-value>
<dmx-value id="varPreviousFirst" dmx-bind:value="'<?php echo date('Y-m-d', mktime(0, 0, 0, date('m')-1, 1))?>'"></dmx-value>
<dmx-value id="varStartDate" dmx-bind:value="'<?php echo date('Y-m-01') ?>'"></dmx-value>
<dmx-value id="varEndDate" dmx-bind:value="'<?php echo date('Y-m-t') ?>'"></dmx-value>

<dmx-datetime id="varDateTime"></dmx-datetime>
<dmx-notifications id="notifies1" offset-x="30" offset-y="30" closable newest-on-top></dmx-notifications>
<dmx-serverconnect id="scAccountList" url="dmxConnect/api/Common/getAccountList.php" noload="noload"></dmx-serverconnect>
<dmx-serverconnect id="scPaymentMethods" url="dmxConnect/api/Common/getPaymentMethods.php" noload="noload"></dmx-serverconnect>
<dmx-serverconnect id="scUnits" url="dmxConnect/api/Common/getUnits.php" noload="noload"></dmx-serverconnect>
<dmx-query-manager id="qm"></dmx-query-manager>
<dmx-serverconnect id="scCategories" url="dmxConnect/api/Common/getItemCategory.php"></dmx-serverconnect>
<dmx-serverconnect id="scGetItems" url="dmxConnect/api/Common/getItems.php" dmx-param:categoryid="collapse1.FilterCategory.value"></dmx-serverconnect>
<dmx-serverconnect id="scExpenseList" noload="noload" url="dmxConnect/api/Expense/ExpenseList.php" dmx-param:categoryid="collapse1.FilterCategory.value" dmx-param:itemid="collapse1.FilterItem.value" dmx-param:offset="query.offset"
	dmx-param:limit="varPageValue.value ? varPageValue.value : 10" dmx-param:currentmonth="collapse1.ThisMonth.checked" dmx-param:crstartdate="varStartDate.value" dmx-param:crenddate="varEndDate.value" dmx-param:date="collapse1.date.value">
</dmx-serverconnect>
<div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
	<div class="d-flex align-items-center flex-wrap mr-1">
		<div class="d-flex align-items-baseline mr-5">
			<h1 class="text-dark my-2 mr-5 font-weight-light">
				Expense List </h1>
		</div>
	</div>
	<div class="d-flex align-items-center">
		<a href="#" class="btn btn-primary font-weight-bold mr-2 py-3" data-toggle="collapse" data-target="#collapse1">
			<i class="flaticon-interface-6"></i>
		</a>
		<a href="./expense/create" class="btn btn-primary font-weight-bold">
			<i class="flaticon-plus"></i>
			Add Expense
		</a>
	</div>
</div>
<div class="d-flex flex-column-fluid pt-2">
	<div class="container-fluid">
		<div class="bg-light-light border card card-custom collapse p-2 show" id="collapse1" is="dmx-bs4-collapse">
			<div class="row">
				<div class="col-lg-3 col-sm-3 form-group">
					<select class="form-control" id="FilterCategory" name="FilterCategory" dmx-bind:options="scCategories.data.getCategories" optiontext="category_name" optionvalue="id" style="width: 100% !important;"
						dmx-on:changed="scGetItems.load()">
						<option value="" selected>Select Category</option>
					</select>
				</div>
				<div class="col-lg-3 col-sm-3 form-group">
					<select class="form-control" id="FilterItem" name="FilterItem" style="width: 100% !important;" dmx-bind:options="scGetItems.data.getItems" optiontext="subcategory_name" optionvalue="id">
						<option value="" selected>Select Item</option>
					</select>
				</div>
				<div class="col-lg-3 col-sm-3 form-group">
					<input type="date" class="form-control" id="date" name="date">
				</div>
				<div class="col-lg-3 col-sm-3 mt-3">
					<div class="custom-control custom-checkbox">
						<label class="checkbox checkbox-outline checkbox-success">
							<input type="checkbox" checked name="ThisMonth" value="1" /> Current Month
							<span></span>
						</label>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<button class="btn btn-dropdown btn-light mr-2" dmx-on:click="FilterCategory.setValue('');FilterItem.setValue('');date.setValue('');scExpenseList.load({offset: 0});" data-toggle="collapse" data-target="#collapse1">Clear</button>
				<button class="btn btn-outline-primary" dmx-on:click="scExpenseList.load({})" data-toggle="collapse" data-target="#collapse1">Search</button>
			</div>
		</div>
	</div>
</div>

<div class="d-flex flex-column-fluid pt-2">
	<div class="container-fluid">
		<div class="card card-custom overflow-hidden shadow-lg">
			<div class="card-body p-3">
				<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th scope="col">INVOICE</th>
								<th scope="col">ITEM</th>
								<th scope="col">AMOUNT</th>
								<th scope="col">QUANTITY</th>
								<th scope="col">DATE</th>
								<th scope="col">PAYMENT</th>
								<th scope="col">REMARK</th>
								<th scope="col" class="text-center">ACTION</th>
							</tr>
						</thead>
						<tbody is="dmx-repeat" id="repeat1" dmx-bind:repeat="scExpenseList.data.queryExpenseList.data.sort(invoice_number)">
							<tr>
								<td>{{invoice_number}}</td>
								<td class="text-truncate">{{ItemName}}</td>
								<td class="font-weight-bolder mt-3 text-truncate">{{amount.toNumber().formatCurrency("₹", ".", ",", "2")}}</td>
								<td class="text-truncate">{{quantity + ' ' + Unit}}</td>
								<td class="text-truncate">{{purchase_date.formatDate("dd MMM yy")}}</td>
								<td class="text-truncate">{{PaymentType}}</td>
								<td class="text-truncate" dmx-bs-tooltip="remark">{{remark.trunc(15, true, "...")}}</td>
								<td class="text-center p-1">
									<button class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="modal" data-target="#modal_update_expense" dmx-on:click="varExpenseID.setValue(Expense_ID)">
										<i class="fa fa-pencil-square-o"></i>
									</button>
								</td>
							</tr>
						</tbody>
						<tbody dmx-hide="scExpenseList.data.queryExpenseList.data.hasItems()">
							<tr>
								<td colspan="8">
									<h4 class="text-center text-muted font-weight-bolder">No expense found this month!</h4>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="d-flex flex-row justify-content-md-center align-items-center my-3">
						<div class="col-9 col-md-auto">
							<div class="d-flex flex-row justify-content-center align-items-center mb-2 mb-md-0">
								<p class="mb-0">Page Size:&nbsp;</p>
								<select class="form-control form-control-sm mr-4 rounded" style="width: 75px;" name="varPageValue" dmx-on:changed="scExpenseList.load()">
									<option value="15" selected>15</option>
									<option value="30">30</option>
									<option value="50">50</option>
									<option value="75">75</option>
									<option value="100">100</option>
								</select>
							</div>
						</div>
						<ul class="pagination justify-content-center flex-row mb-0" dmx-populate="scExpenseList.data.queryExpenseList" dmx-state="qm" dmx-offset="offset" dmx-generator="bs4paging">
							<li class="page-item" dmx-class:disabled="scExpenseList.data.queryExpenseList.page.current == 1" aria-label="First">
								<a href="javascript:void(0)" class="page-link" dmx-on:click="qm.set('offset',scExpenseList.data.queryExpenseList.page.offset.first);scExpenseList.load()"><span aria-hidden="true">&lsaquo;&lsaquo;</span></a>
							</li>
							<li class="page-item" dmx-class:disabled="scExpenseList.data.queryExpenseList.page.current == 1" aria-label="Previous">
								<a href="javascript:void(0)" class="page-link" dmx-on:click="qm.set('offset',scExpenseList.data.queryExpenseList.page.offset.prev);scExpenseList.load()"><span aria-hidden="true">&lsaquo;</span></a>
							</li>
							<li class="page-item" dmx-class:active="title == scExpenseList.data.queryExpenseList.page.current" dmx-class:disabled="!active" dmx-repeat="scExpenseList.data.queryExpenseList.getServerConnectPagination(2,1,'...')">
								<a href="javascript:void(0)" class="page-link" dmx-on:click="qm.set('offset',(page-1)*scExpenseList.data.queryExpenseList.limit);scExpenseList.load()">{{title}}</a>
							</li>
							<li class="page-item" dmx-class:disabled="scExpenseList.data.queryExpenseList.page.current ==  scExpenseList.data.queryExpenseList.page.total" aria-label="Next">
								<a href="javascript:void(0)" class="page-link" dmx-on:click="qm.set('offset',scExpenseList.data.queryExpenseList.page.offset.next);scExpenseList.load()"><span aria-hidden="true">&rsaquo;</span></a>
							</li>
							<li class="page-item" dmx-class:disabled="scExpenseList.data.queryExpenseList.page.current ==  scExpenseList.data.queryExpenseList.page.total" aria-label="Last">
								<a href="javascript:void(0)" class="page-link" dmx-on:click="qm.set('offset',scExpenseList.data.queryExpenseList.page.offset.last);scExpenseList.load()"><span aria-hidden="true">&rsaquo;&rsaquo;</span></a>
							</li>
						</ul>
					</div>


				</div>
			</div>
		</div>
		<!-- <dmx-chart id="chart1" legend="bottom" dmx-bind:data="scExpenseList.data.groupByDateCurrentMonth" labels="purchase_date" dataset-1:value="totalamount" dataset-1:label="Amount" points point-style="line" smooth thickness="4" width="1300"
			height="300" responsive point-size="" cutout="" colors="colors5">
		</dmx-chart> -->
	</div>
</div>

<div class="modal fade" id="modal_update_expense" is="dmx-bs4-modal" tabindex="-1" role="dialog" nocloseonclick dmx-on:show-bs-modal="scAccountList.load();scPaymentMethods.load();scUnits.load()">
	<div class="modal-dialog modal-xl" role="document">
		<form is="dmx-serverconnect-form" id="FormUpdateExpense" method="post" action="dmxConnect/api/Expense/updateExpense.php"
			dmx-on:success="modal_update_expense.hide();modal_update_expense.FormUpdateExpense.reset();varExpenseID.setValue('');notifies1.success(&quot;Expense Updated&quot;);scExpenseList.load()">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update Expense</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="ExpenseID" dmx-bind:value="varExpenseID.value">
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label>Invoice No:</label>
								<input type="number" name="invoice_number" dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`invoice_number`)"
									class="form-control form-control-solid" />
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Invoice Name:</label>
								<input type="text" name="invoice_name" class="form-control form-control-solid" placeholder="Invoice Name"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`invoice_name`)" />
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Date:</label>
								<input type="date" name="purchase_date" class="form-control form-control-solid" placeholder="Purchase Date"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`purchase_date`)" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label>Account</label>
								<select class="form-control" name="account" dmx-bind:options="scAccountList.data.queryAccountList" optiontext="bank_name + ' ' + account_number" optionvalue="id"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`account`)">
									<option selected disabled value="">Account</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Payment Type:</label>
								<select class="form-control" name="payment_type" dmx-bind:options="scPaymentMethods.data.queryPaymentMethods" optiontext="PaymentType" optionvalue="PaymentID"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`payment_type`)">
									<option selected disabled value="">Payment Method</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Remark:</label>
								<input type="text" name="remark" class="form-control form-control-solid" placeholder="Enter full name"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`remark`)" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label>Item:</label>
								<select class="form-control" name="category_id" style="width: 100% !important;" dmx-bind:options="scGetItems.data.getItems" optiontext="subcategory_name" optionvalue="id"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`category_id`)">
									<option value="" selected>Select Item</option>
								</select>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Quantity:</label>
								<input type="number" value="1" name="quantity" class="form-control form-control-solid" placeholder="Quantity"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`quantity`)" />
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label>Unit:</label>
								<select class="form-control" name="unit" style="width: 100% !important;" dmx-bind:options="scUnits.data.queryUnits" optiontext="UnitName" optionvalue="UnitID"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`unitid`)">
									<option value="" selected>Select Item</option>
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label>Amount:</label>
								<input type="number" name="amount" class="form-control form-control-solid" placeholder="Amount"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`amount`)" />
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
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" dmx-bind:disabled="state.executing">Save changes <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>