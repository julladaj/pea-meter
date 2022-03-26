<!DOCTYPE html>
<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="theme/default/demo1/dist/" />
		<meta charset="utf-8" />
		<title>Metronic | Uppy File Upload</title>
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
													Auto Upload With External Sources
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
													Manual Upload Without External Sources & File Limitations
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
								<div class="col-lg-6">
									<div class="kt-portlet kt-portlet--height-fluid">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Quick Drag & Drop Upload
												</h3>
											</div>
										</div>
										<div class="kt-portlet__body">
											<div class="kt-uppy" id="kt_uppy_3">
												<div class="kt-uppy__drag"></div>
												<div class="kt-uppy__informer"></div>
												<div class="kt-uppy__progress"></div>
												<div class="kt-uppy__thumbnails"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="kt-portlet kt-portlet--height-fluid">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Upload
												</h3>
											</div>
										</div>
										<div class="kt-portlet__body">
											<div class="kt-uppy" id="kt_uppy_4">
												<div class="kt-uppy__drag"></div>
												<div class="kt-uppy__informer"></div>
												<div class="kt-uppy__progress"></div>
												<div class="kt-uppy__thumbnails"></div>
												<button class="kt-uppy__btn	 btn btn-label-brand btn-bold btn-sm">Upload File(s)</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="kt-portlet kt-margin-top-30">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													File Uplaod Example In Form Layout
												</h3>
											</div>
										</div>

										<!--begin::Form-->
										<form class="kt-form kt-form--label-right">
											<div class="kt-portlet__body">
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Full Name:</label>
													<div class="col-lg-6">
														<input type="name" class="form-control" placeholder="Enter full name">
														<span class="form-text text-muted">Please enter your full name</span>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Email:</label>
													<div class="col-lg-6">
														<input type="email" class="form-control" placeholder="Enter email">
														<span class="form-text text-muted">Please enter your email</span>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label">Message:</label>
													<div class="col-lg-6">
														<textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Please enter your message"></textarea>
														<span class="form-text text-muted">We'll never share your message with anyone else.</span>
													</div>
												</div>
												<div class="form-group form-group-last row">
													<label class="col-lg-3 col-form-label">Upload File:</label>
													<div class="col-lg-6">
														<div class="kt-uppy" id="kt_uppy_5">
															<div class="kt-uppy__wrapper"></div>
															<div class="kt-uppy__list"></div>
															<div class="kt-uppy__status"></div>
															<div class="kt-uppy__informer kt-uppy__informer--min"></div>
														</div>
														<span class="form-text text-muted">Max file size is 1MB and max number of files is 5.</span>
													</div>
												</div>
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<div class="row">
														<div class="col-lg-3"></div>
														<div class="col-lg-6">
															<button type="reset" class="btn btn-brand">Submit</button>
															<button type="reset" class="btn btn-secondary">Cancel</button>
														</div>
													</div>
												</div>
											</div>
										</form>

										<!--end::Form-->
									</div>
								</div>
								<div class="col-lg-6">
									<div class="kt-portlet kt-portlet--height-fluid">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Popup Upload
												</h3>
											</div>
										</div>
										<div class="kt-portlet__body">
											<div class="kt-uppy" id="kt_uppy_6">
												<button class="kt-uppy__btn btn btn-label-success btn-bold btn-sm">Open Popup Window</button>
												<div class="kt-uppy__dashboard"></div>
												<div class="kt-uppy__progress"></div>
											</div>
										</div>
									</div>
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