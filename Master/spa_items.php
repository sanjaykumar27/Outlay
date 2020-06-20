<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_34="local" id="Items" components="{dmxBootstrap4TableGenerator:{},dmxStateManagement:{}}" -->
<dmx-query-manager id="qm"></dmx-query-manager>
<dmx-serverconnect id="scItemList" url="dmxConnect/api/Master/getItemList.php" noload="noload"></dmx-serverconnect>

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
					<thead>
						<tr>
							<th>Id</th>
							<th>Category</th>
							<th>Items</th>
						</tr>
					</thead>
					<tbody is="dmx-repeat" dmx-generator="bs4table" dmx-bind:repeat="scItemList.data.repeatCategories" id="repeatCategories">
						<tr>
							<td>#</td>
							<td>{{CategoryID}}</td>
							<td class="text-truncate">{{CategoryName}}</td>
							<td>
								<button class="btn mr-2 my-1 btn-outline-primary btn-sm" dmx-repeat:repeat1="queryItems">
									{{ItemName}}
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>