<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_34="local" id="CreateExpense" -->
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
		<form class="form" method="post" is="dmx-serverconnect-form" id="CreateExpense">
			<div class="card-body">
				<h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Invoice Info:</h3>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label>Invoice No:</label>
							<input type="email" class="form-control form-control-solid" placeholder="Enter full name" />
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label>Invoice Name:</label>
							<input type="email" class="form-control form-control-solid" placeholder="Enter full name" />
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label>Date:</label>
							<input type="email" class="form-control form-control-solid" placeholder="Enter full name" />
						</div>
					</div>
				</div>
				<hr>
				<h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Payment Info:</h3>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label>Account</label>
							<input type="email" class="form-control form-control-solid" placeholder="Enter full name" />
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label>Payment Type:</label>
							<input type="email" class="form-control form-control-solid" placeholder="Enter full name" />
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label>Remark:</label>
							<input type="email" class="form-control form-control-solid" placeholder="Enter full name" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group">
							<label>Upload Image</label>
							<input is="dmx-dropzone" id="targetFile" type="file" name="target_photo" thumbs="false" required="" data-msg-required="Please select a file.">
						</div>
					</div>
				</div>
				<hr>
				<h3 class="font-size-lg text-dark font-weight-bold mb-6">3. Item Info:</h3>

				<div class="row" is="dmx-repeat" id="repeatItem" dmx-bind:repeat="varCounter.value">
					<div class="col-lg-3">
						<div class="form-group">
							<label>Date:</label>
							<input type="email" class="form-control form-control-solid" placeholder="Enter full name" />
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label>Date:</label>
							<input type="email" class="form-control form-control-solid" placeholder="Enter full name" />
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label>Date:</label>
							<input type="email" class="form-control form-control-solid" placeholder="Enter full name" />
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label>Date:</label>
							<input type="email" class="form-control form-control-solid" placeholder="Enter full name" />
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label>Date:</label>
							<input type="email" class="form-control form-control-solid" placeholder="Enter full name" />
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
				<button type="reset" class="btn btn-primary mr-2">Submit</button>
			</div>
		</form>
	</div>
</div>