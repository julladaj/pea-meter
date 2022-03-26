<!DOCTYPE html>
<html lang="en">
	
	<!-- begin::Head -->
	<head>
		<base href="theme/default/demo1/dist/" />
		<meta charset="utf-8" />
		<title>การไฟฟ้าส่วนภูมิภาค</title>
		<meta name="description" content="Column search datatables examples">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
		
		<!--end::Fonts -->
		
		<!--begin::Page Vendors Styles(used by this page) -->
		<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		
		<!--end::Page Vendors Styles -->
		
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
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-page--loading">
		
		<!-- begin:: Page -->
		
		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="/pea.php">
					<img alt="Logo" src="assets/media/logos/logo-light.png" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>
		
		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
				
				
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper" style="padding-top: 0;">
					
					
					<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
						
						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
										<h3 class="kt-portlet__head-title">อัพเดท/ระบบบันทึกข้อมูล ติดตั้งมิเตอร์/เพิ่ม/ย้าย/เปลี่ยนประเภท</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="dropdown dropdown-inline">
												<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="la la-download"></i> Export
												</button>
												<div class="dropdown-menu dropdown-menu-right">
													<ul class="kt-nav">
														<li class="kt-nav__section kt-nav__section--first">
															<span class="kt-nav__section-text">Export Tools</span>
														</li>
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link" id="export_print">
																<i class="kt-nav__link-icon la la-print"></i>
																<span class="kt-nav__link-text">Print</span>
															</a>
														</li>
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link" id="export_copy">
																<i class="kt-nav__link-icon la la-copy"></i>
																<span class="kt-nav__link-text">Copy</span>
															</a>
														</li>
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link" id="export_excel">
																<i class="kt-nav__link-icon la la-file-excel-o"></i>
																<span class="kt-nav__link-text">Excel</span>
															</a>
														</li>
														<li class="kt-nav__item">
															<a href="http://pea.chai-van.com/Insert-Edit/excel2.php" class="kt-nav__link">
																<i class="kt-nav__link-icon la la-file-excel-o"></i>
																<span class="kt-nav__link-text">Excel (All)</span>
															</a>
														</li>
													</ul>
												</div>
											</div>
											&nbsp;
											<a href="/pea.php" class="btn btn-brand btn-elevate btn-icon-sm">
												<i class="la la-plus"></i>
												เพิ่มข้อมูล
											</a>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
									
									<!--begin: Datatable -->
									<table class="table table-striped stripe table-bordered table-hover table-checkable hover responsive no-wrap display compact nowrap" id="kt_table_1">
										<thead>
											<tr>
												<th>เลขคำร้อง</th>
												<th>หมายเลขผู้ใช้ไฟ</th>
												<th>วันที่ยื่นคำร้อง</th>
												<th>ชื่อ-นามสกุล</th>
												<th>เบอร์โทรศัพท์</th>
												<th>ประเภทคำร้อง</th>
												<th>ขนาด</th>
												<th>ชื่อผู้รับ</th>
												<th>วันนัดตรวจ</th>
												<th>ชื่อผู้ตรวจ</th>
												<th>ผลการตรวจ</th>
												<th>สาเหตุที่ต้องแก้ไข</th>
												<th>วันที่ชำระเงินค่ามิเตอร์</th>
												<th>ขยายเขต</th>
												<th>วันส่งงานติดตั้ง</th>
												<th>ติดตั้งไม่เกินวันที่</th>
												<th>หมายเลขเครื่องวัด</th>
												<th>วันที่ติดตั้ง แล้วเสร็จ</th>
												<th>เวลาติดตั้ง</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>เลขคำร้อง</th>
												<th>หมายเลขผู้ใช้ไฟ</th>
												<th>วันที่ยื่นคำร้อง</th>
												<th>ชื่อ-นามสกุล</th>
												<th>เบอร์โทรศัพท์</th>
												<th>ประเภทคำร้อง</th>
												<th>ขนาด</th>
												<th>ชื่อผู้รับ</th>
												<th>วันนัดตรวจ</th>
												<th>ชื่อผู้ตรวจ</th>
												<th>ผลการตรวจ</th>
												<th>สาเหตุที่ต้องแก้ไข</th>
												<th>วันที่ชำระเงินค่ามิเตอร์</th>
												<th>ขยายเขต</th>
												<th>วันส่งงานติดตั้ง</th>
												<th>ติดตั้งไม่เกินวันที่</th>
												<th>หมายเลขเครื่องวัด</th>
												<th>วันที่ติดตั้ง แล้วเสร็จ</th>
												<th>เวลาติดตั้ง</th>
												<th>Actions</th>
											</tr>
										</tfoot>
									</table>
									
									<!--end: Datatable -->
								</div>
							</div>
						</div>
						
						<!-- end:: Content -->
					</div>
					
					<!-- begin:: Footer -->
					<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
						<div class="kt-container  kt-container--fluid ">
							<div class="kt-footer__copyright">
								<?php echo date("Y"); ?>&nbsp;&copy;&nbsp;<a href="tel:0840416820" target="_blank" class="kt-link">DSD</a>
							</div>
							<div class="kt-footer__menu">
								<a href="#" target="_blank" class="kt-footer__menu-link kt-link">About</a>
								<a href="#" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
								<a href="#" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
							</div>
						</div>
					</div>
					
					<!-- end:: Footer -->
				</div>
			</div>
		</div>
		
		<!-- end:: Page -->
		
		
		
		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>
		
		<!-- end::Scrolltop -->
		
		<div class="modal fade" id="kt_modal_4_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">New message</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label for="recipient-name" class="form-control-label">Recipient:</label>
								<input type="text" class="form-control" id="recipient-name">
							</div>
							<div class="form-group">
								<label for="message-text" class="form-control-label">Message:</label>
								<textarea class="form-control" id="message-text"></textarea>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Send message</button>
					</div>
				</div>
			</div>
		</div>
		
		
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
		
		<!--begin::Page Vendors(used by this page) -->
		<script src="assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
		
		<!--end::Page Vendors -->
		
		<!--begin::Page Scripts(used by this page) -->
		<script src="assets/js/pages/pea.js" type="text/javascript"></script>
		
		<script>
			
			function loadModalAJAX(e) {
				var url = $(e).attr('url');

				$.ajax({
					url: url,
					type: 'post',
					success: function(response){ 
						console.log(response);
      // Add response in Modal body
      $('#kt_modal_4_2').html(response);
						
      // Display Modal
      $('#kt_modal_4_2').modal('show'); 
					}
				});
			}
			
		</script>
		
		<!--end::Page Scripts -->
	</body>
	
	<!-- end::Body -->
</html>