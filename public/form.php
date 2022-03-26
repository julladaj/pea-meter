<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="theme/default/demo1/dist/" />
		<meta charset="utf-8" />
		<title>Before & After</title>
		<meta name="description" content="Uppy file upload plugin">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Custom Styles(used by this page) -->
		<link href="assets/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Page Custom Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<link href="assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<?php @include('common/header_mobile.php'); ?>
		<!-- end:: Header Mobile -->
		
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<!-- begin:: Aside -->
				<?php @include('common/aside.php'); ?>
				<!-- end:: Aside -->
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

						<!-- begin:: Header Menu -->
						<?php @include('common/header_menu.php'); ?>
						<!-- end:: Header Menu -->

						<!-- begin:: Header Topbar -->
						<?php @include('common/header_topbar.php'); ?>
						<!-- end:: Header Topbar -->
					</div>

					<!-- end:: Header -->
					<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

						<!-- begin:: Subheader -->
						<?php @include('common/subheader.php'); ?>
						<!-- end:: Subheader -->

						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<div class="row">
								<div class="col">
									<div class="alert alert-light alert-elevate fade show" role="alert">
										<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
										<div class="alert-text">
											Uppy is a sleek, modular open source JavaScript file uploader.
											<br> For more info please visit the plugin's <a class="kt-link kt-font-bold" href="https://uppy.io/" target="_blank">Demo Page</a> or
											<a class="kt-link kt-font-bold" href="https://github.com/transloadit/uppy" target="_blank">GitHub</a>.
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="kt-portlet kt-portlet--height-fluid">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Upload film
												</h3>
											</div>
										</div>
										<div class="kt-portlet__body">
											<div class="kt-uppy" id="kt_uppy_1">
												<div class="kt-uppy__dashboard"></div>
												<div class="kt-uppy__progress"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="kt-portlet kt-portlet--height-fluid">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													After
												</h3>
											</div>
										</div>
										<div class="kt-portlet__body">
											<div class="kt-uppy" id="kt_uppy_2">
												<div class="kt-uppy__dashboard"></div>
												<div class="kt-uppy__progress"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">

									<!--begin::Portlet-->
									<div class="kt-portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Base Controls
												</h3>
											</div>
										</div>

										<!--begin::Form-->
										<form class="kt-form">
											<div class="kt-portlet__body">
												<div class="form-group form-group-last">
													<div class="alert alert-secondary" role="alert">
														<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
														<div class="alert-text">
															The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
														</div>
													</div>
												</div>
												<div class="form-group">
													<label>Email address</label>
													<input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
													<span class="form-text text-muted">We'll never share your email with anyone else.</span>
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Password</label>
													<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
												</div>
												<div class="form-group">
													<label>Static:</label>
													<p class="form-control-static">email@example.com</p>
												</div>
												<div class="form-group">
													<label for="exampleSelect1">Example select</label>
													<select class="form-control" id="exampleSelect1">
														<option>1</option>
														<option>2</option>
														<option>3</option>
														<option>4</option>
														<option>5</option>
													</select>
												</div>
												<div class="form-group">
													<label for="exampleSelect2">Example multiple select</label>
													<select multiple="" class="form-control" id="exampleSelect2">
														<option>1</option>
														<option>2</option>
														<option>3</option>
														<option>4</option>
														<option>5</option>
													</select>
												</div>
												<div class="form-group form-group-last">
													<label for="exampleTextarea">Example textarea</label>
													<textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
												</div>
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<button type="reset" class="btn btn-primary">Submit</button>
													<button type="reset" class="btn btn-secondary">Cancel</button>
												</div>
											</div>
										</form>

										<!--end::Form-->
									</div>

									<!--end::Portlet-->

									<!--begin::Portlet-->
									<div class="kt-portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Textual HTML5 Inputs
												</h3>
											</div>
										</div>

										<!--begin::Form-->
										<form class="kt-form kt-form--label-right">
											<div class="kt-portlet__body">
												<div class="form-group form-group-last">
													<div class="alert alert-secondary" role="alert">
														<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
														<div class="alert-text">
															Here are examples of <code>.form-control</code> applied to each textual HTML5 input type:
														</div>
													</div>
												</div>
												<div class="form-group row">
													<label for="example-text-input" class="col-2 col-form-label">Text</label>
													<div class="col-10">
														<input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-search-input" class="col-2 col-form-label">Search</label>
													<div class="col-10">
														<input class="form-control" type="search" value="How do I shoot web" id="example-search-input">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-email-input" class="col-2 col-form-label">Email</label>
													<div class="col-10">
														<input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-url-input" class="col-2 col-form-label">URL</label>
													<div class="col-10">
														<input class="form-control" type="url" value="https://getbootstrap.com" id="example-url-input">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-tel-input" class="col-2 col-form-label">Telephone</label>
													<div class="col-10">
														<input class="form-control" type="tel" value="1-(555)-555-5555" id="example-tel-input">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-password-input" class="col-2 col-form-label">Password</label>
													<div class="col-10">
														<input class="form-control" type="password" value="hunter2" id="example-password-input">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-number-input" class="col-2 col-form-label">Number</label>
													<div class="col-10">
														<input class="form-control" type="number" value="42" id="example-number-input">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-datetime-local-input" class="col-2 col-form-label">Date and time</label>
													<div class="col-10">
														<input class="form-control" type="datetime-local" value="2011-08-19T13:45:00" id="example-datetime-local-input">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-date-input" class="col-2 col-form-label">Date</label>
													<div class="col-10">
														<input class="form-control" type="date" value="2011-08-19" id="example-date-input">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-month-input" class="col-2 col-form-label">Month</label>
													<div class="col-10">
														<input class="form-control" type="month" value="2011-08" id="example-month-input">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-week-input" class="col-2 col-form-label">Week</label>
													<div class="col-10">
														<input class="form-control" type="week" value="2011-W33" id="example-week-input">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-time-input" class="col-2 col-form-label">Time</label>
													<div class="col-10">
														<input class="form-control" type="time" value="13:45:00" id="example-time-input">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-color-input" class="col-2 col-form-label">Color</label>
													<div class="col-10">
														<input class="form-control" type="color" value="#563d7c" id="example-color-input">
													</div>
												</div>
												<div class="form-group row">
													<label for="example-email-input" class="col-2 col-form-label">Range</label>
													<div class="col-10">
														<input class="form-control" type="range">
													</div>
												</div>
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-2">
														</div>
														<div class="col-10">
															<button type="reset" class="btn btn-success">Submit</button>
															<button type="reset" class="btn btn-secondary">Cancel</button>
														</div>
													</div>
												</div>
											</div>
										</form>
									</div>

									<!--end::Portlet-->
								</div>
								<div class="col-md-6">

									<!--begin::Portlet-->
									<div class="kt-portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													OCR Result
												</h3>
											</div>
										</div>

										<!--begin::Form-->
										<form class="kt-form">
											<div class="kt-portlet__body">
												<div class="form-group form-group-last">
													<div class="alert alert-secondary" role="alert">
														<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
														<div class="alert-text">
															Add the disabled or readonly boolean attribute on an input to prevent user interactions.
															Disabled inputs appear lighter and add a <code>not-allowed</code> cursor.
														</div>
													</div>
												</div>
												<div class="form-group">
													<label>Disabled Input</label>
													<input type="email" class="form-control" disabled="disabled" placeholder="Disabled input">
												</div>
												<div class="form-group">
													<label>Disabled select</label>
													<select class="form-control" disabled="disabled">
														<option>1</option>
														<option>2</option>
														<option>3</option>
														<option>4</option>
														<option>5</option>
													</select>
												</div>
												<div class="form-group">
													<label for="exampleTextarea">Disabled textarea</label>
													<textarea class="form-control" disabled="disabled" rows="3"></textarea>
												</div>
												<div class="form-group">
													<label>Readonly Input</label>
													<input type="email" class="form-control" readonly placeholder="Readonly input">
												</div>
												<div class="form-group">
													<label for="exampleTextarea">Readonly textarea</label>
													<textarea class="form-control" readonly rows="3"></textarea>
												</div>
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<button type="reset" class="btn btn-brand">Submit</button>
													<button type="reset" class="btn btn-secondary">Cancel</button>
												</div>
											</div>
										</form>

										<!--end::Form-->
									</div>

									<!--end::Portlet-->

									<!--begin::Portlet-->
									<div class="kt-portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Input Sizing
												</h3>
											</div>
										</div>

										<!--begin::Form-->
										<form class="kt-form">
											<div class="kt-portlet__body">
												<div class="form-group form-group-last">
													<div class="alert alert-secondary" role="alert">
														<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
														<div class="alert-text">
															Set heights using classes like <code>.form-control-lg</code>, and set widths using grid column classes like <code>.col-lg-*</code>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label>Large Input</label>
													<input type="email" class="form-control form-control-lg" aria-describedby="emailHelp" placeholder="Large input">
												</div>
												<div class="form-group">
													<label>Default Input</label>
													<input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Large input">
												</div>
												<div class="form-group">
													<label>Small Input</label>
													<input type="email" class="form-control form-control-sm" aria-describedby="emailHelp" placeholder="Large input">
												</div>
												<div class="form-group">
													<label for="exampleSelectl">Large Select</label>
													<select class="form-control form-control-lg" id="exampleSelectl">
														<option>1</option>
														<option>2</option>
														<option>3</option>
														<option>4</option>
														<option>5</option>
													</select>
												</div>
												<div class="form-group">
													<label for="exampleSelectd">Default Select</label>
													<select class="form-control" id="exampleSelectd">
														<option>1</option>
														<option>2</option>
														<option>3</option>
														<option>4</option>
														<option>5</option>
													</select>
												</div>
												<div class="form-group">
													<label for="exampleSelects">Small Select</label>
													<select class="form-control form-control-sm" id="exampleSelects">
														<option>1</option>
														<option>2</option>
														<option>3</option>
														<option>4</option>
														<option>5</option>
													</select>
												</div>
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<button type="reset" class="btn btn-success">Submit</button>
													<button type="reset" class="btn btn-secondary">Cancel</button>
												</div>
											</div>
										</form>

										<!--end::Form-->
									</div>

									<!--end::Portlet-->

									<!--begin::Portlet-->
									<div class="kt-portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Custom Controls
												</h3>
											</div>
										</div>

										<!--begin::Form-->
										<form class="kt-form">
											<div class="kt-portlet__body">
												<div class="form-group form-group-last">
													<div class="alert alert-secondary" role="alert">
														<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
														<div class="alert-text">
															For even more customization and cross browser consistency, use our completely custom form elements to replace the browser defaults. They’re built on top of semantic and accessible markup, so they’re solid replacements for any default form control.
														</div>
													</div>
												</div>
												<div class="form-group">
													<label>Custom Range</label>
													<div></div>
													<input type="range" class="custom-range" min="0" max="5" id="customRange2">
												</div>
												<div class="form-group">
													<label>Custom Select</label>
													<div></div>
													<select class="custom-select form-control">
														<option selected>Open this select menu</option>
														<option value="1">One</option>
														<option value="2">Two</option>
														<option value="3">Three</option>
													</select>
												</div>
												<div class="form-group">
													<label>File Browser</label>
													<div></div>
													<div class="custom-file">
														<input type="file" class="custom-file-input" id="customFile">
														<label class="custom-file-label" for="customFile">Choose file</label>
													</div>
												</div>
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<button type="reset" class="btn btn-primary">Submit</button>
													<button type="reset" class="btn btn-secondary">Cancel</button>
												</div>
											</div>
										</form>

										<!--end::Form-->
									</div>

									<!--end::Portlet-->
								</div>
							</div>
							
						</div>

						<!-- end:: Content -->
					</div>

					<!-- begin:: Footer -->
					<?php @include('common/footer.php'); ?>
					<!-- end:: Footer -->
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Quick Panel -->
		<?php @include('common/quick_panel.php'); ?>
		<!-- end::Quick Panel -->

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>

		<!-- end::Scrolltop -->

		<!-- begin::Sticky Toolbar -->
		<?php @include('common/sticky_toolbar.php'); ?>
		<!-- end::Sticky Toolbar -->

		<!-- begin::Demo Panel -->
		<?php @include('common/demo_panel.php'); ?>
		<!-- end::Demo Panel -->

		<!--Begin:: Chat-->
		<?php @include('common/chat.php'); ?>
		<!--ENd:: Chat-->

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
		<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts(used by this page) -->
		<script src="assets/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
		<script src="assets/js/pages/crud/file-upload/uppy.js" type="text/javascript"></script>

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>