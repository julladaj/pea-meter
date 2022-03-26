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
													Before
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