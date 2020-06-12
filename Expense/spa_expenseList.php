<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_33="cdn" id="ExpenseList" components="{dmxStateManagement:{},dmxBootstrap4Collapse:{},dmxFormatter:{},dmxBootstrap4Tooltips:{},dmxBootstrap4PagingGenerator:{}}" -->
<dmx-value id="varPreviousLast" dmx-bind:value="'<?php echo date('Y-m-d', mktime(0, 0, 0, date('m'), 0)) ?>'"></dmx-value>
<dmx-value id="varPreviousFirst" dmx-bind:value="'<?php echo date('Y-m-d', mktime(0, 0, 0, date('m')-1, 1))?>'"></dmx-value>
<dmx-value id="varStartDate" dmx-bind:value="'<?php echo date('Y-m-01') ?>'"></dmx-value>
<dmx-value id="varEndDate" dmx-bind:value="'<?php echo date('Y-m-t') ?>'"></dmx-value>
<dmx-query-manager id="qm"></dmx-query-manager>
<dmx-serverconnect id="scCategories" url="dmxConnect/api/Common/getItemCategory.php"></dmx-serverconnect>
<dmx-serverconnect id="scGetItems" url="dmxConnect/api/Common/getItems.php" dmx-param:categoryid="collapse1.FilterCategory.value"></dmx-serverconnect>
<dmx-serverconnect id="scExpenseList" noload="noload" url="dmxConnect/api/Expense/ExpenseList.php" dmx-param:categoryid="collapse1.FilterCategory.value" dmx-param:itemid="collapse1.FilterItem.value" dmx-param:offset="query.offset"
	dmx-param:limit="varPageValue.value ? varPageValue.value : 10" dmx-param:currentmonth="collapse1.ThisMonth.checked" dmx-param:crstartdate="varStartDate.value" dmx-param:crenddate="varEndDate.value" dmx-param:date="collapse1.date.value">
</dmx-serverconnect>
<div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
	<!--begin::Info-->
	<div class="d-flex align-items-center flex-wrap mr-1">
		<!--begin::Page Heading-->
		<div class="d-flex align-items-baseline mr-5">
			<!--begin::Page Title-->
			<h1 class="text-dark my-2 mr-5 font-weight-light">
				Expense List </h1>
			<!--end::Page Title-->
		</div>
		<!--end::Page Heading-->
	</div>
	<!--end::Info-->

	<!--begin::Toolbar-->
	<div class="d-flex align-items-center">
		<!--begin::Actions-->
		<a href="#" class="btn btn-icon btn-light-primary btn-sm mr-2" data-toggle="collapse" data-target="#collapse1">
			<i class="flaticon-interface-6"></i>
		</a>
		<a href="./expense/create" class="btn btn-primary font-weight-bold btn-sm">
			<i class="flaticon-plus"></i>
			Add Expense
		</a>
	</div>

	<!--end::Toolbar-->
</div>
<div class="d-flex flex-column-fluid pt-2">
	<div class="container-fluid">
		<dmx-chart id="chart1" legend="bottom" dmx-bind:data="scExpenseList.data.groupByDateCurrentMonth" labels="purchase_date" dataset-1:value="totalamount" dataset-1:label="Amount" points point-style="line" smooth thickness="4" width="1300"
			height="300" responsive point-size="" cutout="" colors="colors5">
		</dmx-chart>
		<div class="bg-light-light border card card-custom collapse p-2 show" id="collapse1" is="dmx-bs4-collapse">
			<div class="form-group row">
				<div class="col-lg-3">
					<select class="form-control" id="FilterCategory" name="FilterCategory" dmx-bind:options="scCategories.data.getCategories" optiontext="category_name" optionvalue="id" style="width: 100% !important;"
						dmx-on:changed="scGetItems.load()">
						<option value="" selected>Select Category</option>
					</select>
				</div>
				<div class="col-lg-3">
					<select class="form-control" id="FilterItem" name="FilterItem" style="width: 100% !important;" dmx-bind:options="scGetItems.data.getItems" optiontext="subcategory_name" optionvalue="id">
						<option value="" selected>Select Item</option>
					</select>
				</div>
				<div class="col-lg-3">
					<input type="date" class="form-control" id="date" name="date">
				</div>
				<div class="col-lg-2 mt-3">
					<div class="custom-control custom-checkbox">
						<label class="checkbox checkbox-outline checkbox-success">
							<input type="checkbox" checked name="ThisMonth" value="1" /> Current Month
							<span></span>
						</label>
					</div>
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<button class="btn btn-dropdown btn-light mr-2" dmx-on:click="FilterCategory.setValue('');FilterItem.setValue('');date.setValue('');scExpenseList.load({offset: 0});" data-toggle="collapse" data-target="#collapse1">Clear</button>
				<button class="btn btn-outline-primary" dmx-on:click="scExpenseList.load({})" data-toggle="collapse" data-target="#collapse1">Search</button>
			</div>
		</div>
	</div>
</div>

<div class="d-flex flex-column-fluid pt-2">
	<div class="container-fluid">
		<div class="card card-custom overflow-hidden">
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table table-hover table-striped font-weight-bolder">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">INVOICE</th>
								<th scope="col">ITEM</th>
								<th scope="col">AMOUNT</th>
								<th scope="col">QUANTITY</th>
								<th scope="col">DATE</th>
								<th scope="col">PAYMENT</th>
								<th scope="col">REMARK</th>
							</tr>
						</thead>
						<tbody is="dmx-repeat" id="repeat1" dmx-bind:repeat="scExpenseList.data.queryExpenseList.data">
							<tr>
								<th scope="row">{{$index + scExpenseList.data.queryExpenseList.data.offset.toNumber() + 1}}</th>
								<td>{{invoice_number}}</td>
								<td>{{ItemName}}</td>
								<td class="label label-lg label-light-danger label-inline  font-weight-bolder mt-3">{{amount.toNumber().formatCurrency("₹", ".", ",", "2")}}</td>
								<td>{{quantity + ' ' + Unit}}</td>
								<td>{{purchase_date.formatDate("dd MMM yy")}}</td>
								<td>{{PaymentType}}</td>
								<td dmx-bs-tooltip="remark">{{remark.trunc(15, true, "...")}}</td>
							</tr>
						</tbody>
					</table>

					<ul class="pagination justify-content-center" dmx-populate="scExpenseList.data.queryExpenseList" dmx-state="qm" dmx-offset="offset" dmx-generator="bs4paging">
						<select class="form-control form-control-sm text-primary bg-light-light mr-4 rounded" style="width: 75px;" name="varPageValue" dmx-on:changed="scExpenseList.load()">
							<option value="10" selected>10</option>
							<option value="30">30</option>
							<option value="50">50</option>
							<option value="75">75</option>
							<option value="100">100</option>
						</select>
						<li class="page-item" dmx-class:disabled="scExpenseList.data.queryExpenseList.page.current == 1" aria-label="First">
							<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" dmx-on:click="qm.set('offset',scExpenseList.data.queryExpenseList.page.offset.first);scExpenseList.load()"><span
									aria-hidden="true">&lsaquo;&lsaquo;</span></a>
						</li>
						<li class="page-item" dmx-class:disabled="scExpenseList.data.queryExpenseList.page.current == 1" aria-label="Previous">
							<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" dmx-on:click="qm.set('offset',scExpenseList.data.queryExpenseList.page.offset.prev);scExpenseList.load()"><span
									aria-hidden="true">&lsaquo;</span></a>
						</li>
						<li class="page-item" dmx-class:active="title == scExpenseList.data.queryExpenseList.page.current" dmx-class:disabled="!active" dmx-repeat:gfgf="scExpenseList.data.queryExpenseList.getServerConnectPagination(2,1,'...')">
							<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1" dmx-on:click="qm.set('offset',(page-1)*scExpenseList.data.queryExpenseList.limit);scExpenseList.load()">{{title}}</a>
						</li>
						<li class="page-item" dmx-class:disabled="scExpenseList.data.queryExpenseList.page.current ==  scExpenseList.data.queryExpenseList.page.total" aria-label="Next">
							<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" dmx-on:click="qm.set('offset',scExpenseList.data.queryExpenseList.page.offset.next);scExpenseList.load()"><span
									aria-hidden="true">&rsaquo;</span></a>
						</li>
						<li class="page-item" dmx-class:disabled="scExpenseList.data.queryExpenseList.page.current ==  scExpenseList.data.queryExpenseList.page.total" aria-label="Last">
							<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" dmx-on:click="qm.set('offset',scExpenseList.data.queryExpenseList.page.offset.last);scExpenseList.load()"><span
									aria-hidden="true">&rsaquo;&rsaquo;</span></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>