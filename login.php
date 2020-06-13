<!doctype html>
<html>

<head>
	<meta name="ac:base" content="/outlay">
	<base href="/outlay/">
	<script src="dmxAppConnect/dmxAppConnect.js"></script>
	<meta charset="utf-8" />
	<title>OUTLAY | Login Page 1</title>
	<meta name="description" content="Login page example" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
	<!--begin::Page Custom Styles(used by this page)-->
	<link href="assets/css/pages/login/login-179e8.css" rel="stylesheet" type="text/css" />

	<link href="assets/plugins/global/plugins.bundle79e8.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/custom/prismjs/prismjs.bundle79e8.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle79e8.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="" />

	<link rel="stylesheet" href="dmxAppConnect/dmxNotifications/dmxNotifications.css" />
	<script src="dmxAppConnect/dmxNotifications/dmxNotifications.js" defer=""></script>
	<script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer=""></script>
</head>

<body is="dmx-app" id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled sidebar-enabled page-loading">
	<div is="dmx-browser" id="browser1"></div>
	<dmx-notifications id="notifies1"></dmx-notifications>
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
		<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
			<!--begin::Aside-->
			<div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
				<!--begin::Aside Top-->
				<div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
					<!--begin::Aside header-->
					<a href="#" class="text-center mb-10">
						<img src="assets/media/logos/logo-letter-1.png" class="max-h-70px" alt="" />
					</a>

					<h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">
						Discover Amazing OUTLAY<br />
						with great build tools
					</h3>

				</div>
				<!--end::Aside Top-->

				<!--begin::Aside Bottom-->
				<div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
					style="background-image: url(https://keenthemes.com/metronic/themes/metronic/theme/html/demo10/dist/assets/media/svg/illustrations/login-visual-1.svg)"></div>
				<!--end::Aside Bottom-->
			</div>
			<!--begin::Aside-->

			<!--begin::Content-->
			<div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
				<!--begin::Content body-->
				<div class="d-flex flex-column-fluid flex-center">
					<!--begin::Signin-->
					<div class="login-form login-signin">
						<!--begin::Form-->
						<form class="form" method="post" novalidate="novalidate" id="auth-form" is="dmx-serverconnect-form" action="dmxConnect/api/AccessControl/Login.php"
							dmx-on:success="notifies1.success(&quot;Succesfully Logged In&quot;);browser1.goto('./')" dmx-on:unauthorized="notifies1.danger(&quot;Invalid Login&quot;)">
							<!--begin::Title-->
							<div class="pb-13 pt-lg-0 pt-5">
								<h3 class="text-dark" style="font-weight:300;font-size:32px">Welcome to OUTLAYY</h3>
								<span class="text-muted font-weight-bold font-size-h4">New Here? <a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span>
							</div>
							<!--begin::Title-->

							<div class="form-group">
								<label class="font-size-h6 font-weight-bolder text-dark">Email/Username</label>
								<input class="form-control form-control-solid h-auto py-5 px-6 rounded-lg" type="text" name="username" autocomplete="off" />
							</div>
							<!--end::Form group-->

							<div class="form-group">
								<div class="d-flex justify-content-between mt-n5">
									<label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>

									<a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">
										Forgot Password ?
									</a>
								</div>

								<input class="form-control form-control-solid h-auto py-5 px-6 rounded-lg" type="password" name="password" autocomplete="off" />
							</div>
							<!--end::Form group-->

							<!--begin::Action-->
							<div class="pb-lg-0 pb-5">
								<button type="submit" id="m_login_signin_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" dmx-bind:disabled="state.executing">Sign In <span
										class="spinner-grow spinner-grow-sm" role="status" dmx-show="state.executing"></span>
								</button>
							</div>
							<!--end::Action-->
						</form>
					</div>

					<div class="login-form login-signup">
						<form class="form" novalidate="novalidate" id="kt_login_signup_form">
							<!--begin::Title-->
							<div class="pb-13 pt-lg-0 pt-5">
								<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Sign Up</h3>
								<p class="text-muted font-weight-bold font-size-h4">Enter your details to create your account</p>
							</div>
							<!--end::Title-->

							<!--begin::Form group-->
							<div class="form-group">
								<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="text" placeholder="Fullname" name="fullname" autocomplete="off" />
							</div>
							<!--end::Form group-->

							<!--begin::Form group-->
							<div class="form-group">
								<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off" />
							</div>
							<!--end::Form group-->

							<!--begin::Form group-->
							<div class="form-group">
								<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="password" placeholder="Password" name="password" autocomplete="off" />
							</div>
							<!--end::Form group-->

							<!--begin::Form group-->
							<div class="form-group">
								<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="password" placeholder="Confirm password" name="cpassword" autocomplete="off" />
							</div>
							<!--end::Form group-->

							<!--begin::Form group-->
							<div class="form-group">
								<label class="checkbox mb-0">
									<input type="checkbox" name="agree" />I Agree the <a href="#">terms and conditions</a>.
									<span></span>
								</label>
							</div>
							<!--end::Form group-->

							<!--begin::Form group-->
							<div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
								<button type="button" id="kt_login_signup_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
								<button type="button" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
							</div>
							<!--end::Form group-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Signup-->

					<!--begin::Forgot-->
					<div class="login-form login-forgot">
						<!--begin::Form-->
						<form class="form" novalidate="novalidate" id="kt_login_forgot_form">
							<!--begin::Title-->
							<div class="pb-13 pt-lg-0 pt-5">
								<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forgotten Password ?</h3>
								<p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password</p>
							</div>
							<!--end::Title-->

							<!--begin::Form group-->
							<div class="form-group">
								<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off" />
							</div>
							<!--end::Form group-->

							<!--begin::Form group-->
							<div class="form-group d-flex flex-wrap pb-lg-0">
								<button type="button" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
								<button type="button" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
							</div>
							<!--end::Form group-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Forgot-->
				</div>
				<!--end::Content body-->

				<!--begin::Content footer-->
				<div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
					<a href="#" class="text-primary font-weight-bolder font-size-h5">Terms</a>
					<a href="#" class="text-primary ml-10 font-weight-bolder font-size-h5">Plans</a>
					<a href="#" class="text-primary ml-10 font-weight-bolder font-size-h5">Contact Us</a>
				</div>
				<!--end::Content footer-->
			</div>
			<!--end::Content-->
		</div>
		<!--end::Login-->
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="assets/plugins/global/plugins.bundle79e8.js"></script>
	<script src="assets/plugins/custom/prismjs/prismjs.bundle79e8.js"></script>
	<script src="assets/js/scripts.bundle79e8.js"></script>
</body>

</html>