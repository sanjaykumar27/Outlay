<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_34="local" id="Items" components="{dmxBootstrap4TableGenerator:{},dmxStateManagement:{},dmxBootstrap4PagingGenerator:{}}" -->
<dmx-query-manager id="qm"></dmx-query-manager>
<dmx-serverconnect id="scItemList" url="dmxConnect/api/Master/getItemList.php" noload="noload" dmx-param:limit="varPageValue.value ? varPageValue.value : 10" dmx-param:offset="query.offset" dmx-param:sort="" dmx-param:dir=""></dmx-serverconnect>

<div class="container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
	<div class="d-flex align-items-center flex-wrap mr-1">
		<div class="d-flex align-items-baseline mr-5">
			<h1 class="text-dark my-2 mr-5 font-weight-light">
				All Items </h1>
		</div>
	</div>
	<div class="d-flex align-items-center">
		<button class="btn btn-primary font-weight-bold btn-sm" data-toggle="modal" data-target="#createtarget">
			<i class="flaticon-plus"></i>
			Add Category
		</button>
	</div>
</div>

<div class="d-flex flex-column-fluid pt-2">
	<div class="container-fluid">
		<div class="row">
			<div class="table-responsive">
				<table class="table table-striped table-hover font-weight-bolder">
					<thead class="text-uppercase">
						<tr>
							<th>#</th>
							<th>Category</th>
							<th>Items</th>
						</tr>
					</thead>
					<tbody is="dmx-repeat" dmx-generator="bs4table" dmx-bind:repeat="scItemList.data.repeatCategories" id="repeatCategories">
						<tr>
							<td>{{$index + qm.data.offset.toNumber() + 1}}</td>
							<td class="text-truncate">{{CategoryName}}</td>
							<td>
								<span class="mr-2 my-1 badge custom-pill" dmx-repeat:repeat1="queryItems">
									{{ItemName}}
								</span>
							</td>
						</tr>

					</tbody>
				</table>

			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">

				<ul class="pagination justify-content-center" dmx-populate="scItemList.data.getCategories" dmx-state="qm" dmx-offset="offset" dmx-generator="bs4paging">
					<select class="form-control form-control-sm text-primary bg-light-light mr-4 rounded" style="width: 75px;" name="varPageValue" dmx-on:changed="scItemList.load()">
						<option value="10" selected>10</option>
						<option value="30">30</option>
						<option value="50">50</option>
						<option value="75">75</option>
						<option value="100">100</option>
					</select>
					<li class="page-item" dmx-class:disabled="scItemList.data.getCategories.page.current == 1" aria-label="First">
						<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" dmx-on:click="qm.set('offset',scItemList.data.getCategories.page.offset.first);scItemList.load()"><span
								aria-hidden="true">&lsaquo;&lsaquo;</span></a>
					</li>
					<li class="page-item" dmx-class:disabled="scItemList.data.getCategories.page.current == 1" aria-label="Previous">
						<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" dmx-on:click="qm.set('offset',scItemList.data.getCategories.page.offset.prev);scItemList.load()"><span
								aria-hidden="true">&lsaquo;</span></a>
					</li>
					<li class="page-item" dmx-class:active="title == scItemList.data.getCategories.page.current" dmx-class:disabled="!active" dmx-repeat="scItemList.data.getCategories.getServerConnectPagination(2,1,'...')">
						<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" dmx-on:click="qm.set('offset',(page-1)*scItemList.data.getCategories.limit);scItemList.load()">{{title}}</a>
					</li>
					<li class="page-item" dmx-class:disabled="scItemList.data.getCategories.page.current ==  scItemList.data.getCategories.page.total" aria-label="Next">
						<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" dmx-on:click="qm.set('offset',scItemList.data.getCategories.page.offset.next);scItemList.load()"><span
								aria-hidden="true">&rsaquo;</span></a>
					</li>
					<li class="page-item" dmx-class:disabled="scItemList.data.getCategories.page.current ==  scItemList.data.getCategories.page.total" aria-label="Last">
						<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" dmx-on:click="qm.set('offset',scItemList.data.getCategories.page.offset.last);scItemList.load()"><span
								aria-hidden="true">&rsaquo;&rsaquo;</span></a>
					</li>
					<span class="ml-3 pt-2 datatable-pager-detail">Showing {{scItemList.data.getCategories.limit}} of {{scItemList.data.getCategories.total}}</span>
				</ul>

			</div>
		</div>
	</div>
</div>