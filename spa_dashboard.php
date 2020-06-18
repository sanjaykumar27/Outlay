<!-- Wappler include head-page="index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_34="local" id="Dashboard" -->
<dmx-serverconnect id="scMonthlyReport" url="dmxConnect/api/Dashboard/getMonthlyExpense.php"></dmx-serverconnect>
<div class=" container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
	<!--begin::Info-->
	<div class="d-flex align-items-center flex-wrap mr-1">
		<!--begin::Page Heading-->
		<div class="d-flex align-items-baseline mr-5">
			<!--begin::Page Title-->
			<h1 class="text-dark my-2 mr-5 font-weight-light">
				Dashboard </h1>
			<!--end::Page Title-->
		</div>
		<!--end::Page Heading-->
	</div>

</div>
<div class="d-flex flex-column-fluid pt-2">
	<div class="container-fluid">
		<div class="row col-lg-8">
			<div class="card card-custom gutter-b ">
				<div class="card-header h-auto border-0">
					<div class="card-title py-5">
						<h3 class="card-label">
							<span class="d-block text-dark font-weight-bolder">Recent Orders</span>
							<span class="d-block text-muted mt-2 font-size-sm">More than 500+ new orders</span>
						</h3>
					</div>
					<div class="card-toolbar">
						<ul class="nav nav-pills nav-pills-sm nav-dark-75" role="tablist">
							<li class="nav-item">
								<a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_charts_widget_2_chart_tab_1">
									<span class="nav-text font-size-sm">Month</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_charts_widget_2_chart_tab_2">
									<span class="nav-text font-size-sm">Week</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link py-2 px-4 active" data-toggle="tab" href="#kt_charts_widget_2_chart_tab_3">
									<span class="nav-text font-size-sm">Day</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="card-body">
					<dmx-chart id="chart1" legend="bottom" dmx-bind:data="scMonthlyReport.data.monthlyExpense" labels="dates" dataset-1:value="amount" dataset-1:label="Amount" points point-style="line" smooth thickness="4" width="450px"
						height="350px" responsive point-size="" cutout="" colors="colors5" noanimation>
					</dmx-chart>
				</div>
			</div>
		</div>
	</div>
</div>