<?php 
	@require_once('config.php');
	@require_once('class/meter.php');
	
	$meter = new _Meter();
	
	if (isset($_POST['auto_id']) && isset($_POST['token'])) {
		//file_put_contents("log/log.txt", print_r($_POST, true));
		
		$result = $meter->updateMeter($_POST);
		if (!$result['auto_id']) {
			print_r($result);
			exit;
		}
		header('location: /meter/admin.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	
	<!-- begin::Head -->
	<head>
		<base href="../theme/default/demo1/dist/" />
		<meta charset="utf-8" />
		<title>ตรวจสอบสถานะคำร้อง</title>
		<meta name="description" content="Column search datatables examples">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!--begin::Fonts -->
		<!--end::Fonts -->
		
		<!--begin::Page Vendors Styles(used by this page) -->
		
		
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
		
		<link href="assets/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
		
		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<style>
		div.filter-control input.form-control {
			padding: 0.2rem;
			font-size: inherit;
		}
		div.filter-control select.form-control {
			padding: 0.2rem;
			font-size: inherit;
		}
		table th.highlight {
			background-color: #fff700;
		}
		.kt-portlet{
			background-color: #ddd;
		}
		input.search-input {
			width: 600px;
		}
		</style>
	</head>
	
	<!-- end::Head -->
	
	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-page--loading">
		
		<!-- begin:: Page -->
		
		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="/meter/">
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
										<h3 class="kt-portlet__head-title">ตรวจสอบสถานะคำร้องการ ติดตั้งมิเตอร์/เพิ่มขนาด/ย้าย/เปลี่ยนประเภท <b>(เบอร์โทรศัพท์สำนักงาน 053-896020)</b></h3>
									</div>
								</div>
								<div class="kt-portlet__body">
								<!--begin: Datatable -->
								<table class="display table table-bordered table-striped" id="table_meter_client" 
									data-sort-name="auto_id" 
									data-search="true"
									data-sort-order="desc"
									data-ajax="ajaxRequest" 
									data-side-pagination="server" 
									data-show-refresh="true"
									data-show-columns="true" 
									data-pagination="true" 
									data-filter="true"
									data-remember-order="true"
									data-show-search-clear-button="true"
									data-state-save="true"
									data-state-save-id-table="table_meter_client"
									data-cookie="true"
									data-cookie-expire="7d"
									data-cookie-id-table="table_meter_client">
										<thead>
											<tr>
												<th data-field="auto_id" data-sortable="true">เลขคำร้อง</th>
												<th data-field="number1" data-sortable="true">หมายเลขผู้ใช้ไฟ</th>
												<th data-field="fname" data-sortable="true">ชื่อ นามสกุล</th>
												<th data-field="meter_category_id" data-sortable="true" data-formatter="meter_category_detail">ประเภทคำร้อง</th>
												<th data-field="meter_size_detail" data-sortable="true">ขนาดมิเตอร์</th>
												<th data-field="date_appoint" data-sortable="true">วันนัดตรวจ<br>(09.00น.-16.30น.)</th>
												<th data-field="meter_qc_id" data-sortable="true" data-formatter="meter_qc_detail">ผลการตรวจ</th>
												<th data-field="cause" data-sortable="true">สาเหตุที่ต้องแก้ไข</th>
												<th data-field="date_payment" data-sortable="true">วันที่ชำระเงินค่ามิเตอร์</th>
												<th data-field="cause1" data-sortable="true">ขยายเขต</th>
												<th data-field="date_install" data-sortable="true">วันส่งงานติดตั้ง</th>
												<th data-field="date_deathline" data-sortable="true">ติดตั้งไม่เกินวันที่</th>
												<th data-field="number2" data-sortable="true">หมายเลขเครื่องวัด</th>
												<th data-field="date_finish" data-sortable="true">วันที่ติดตั้ง แล้วเสร็จ</th>
										</tr>
									</thead>
								</table>
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
		<script src="assets/plugins/bootstrap-table/bootstrap-table.min.js"></script>
		<script src="assets/plugins/bootstrap-table/bootstrap-table-filter-control.min.js"></script>
		<script src="assets/plugins/bootstrap-table/bootstrap-table-cookie.js" type="text/javascript"></script>
		<!--<script src="assets/plugins/bootstrap-table/bootstrap-table-th-TH.js" type="text/javascript"></script>-->
		<!--end::Page Vendors -->
		
		<!--begin::Page Scripts(used by this page) -->
		
		<script>
		function meter_qc_detail(value, row) {
			return row.meter_qc_detail;
		}
		function meter_category_detail(value, row) {
			return row.meter_category_detail;
		}
		
	function myFunction() {
		var input, filter, table, tr, td, i, txtValue;
		input = document.getElementById("myInput");
		filter = input.value.toUpperCase();
		table = document.getElementById("table_meter_client");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[0];
				if (td) {
						txtValue = td.textContent || td.innerText;
						if (txtValue.toUpperCase().indexOf(filter) > -1) {
								tr[i].style.display = "";
						} else {
								tr[i].style.display = "none";
						}
				}       
		}
	}
		
		
		function ajaxRequest(params) {
			$.ajax({
				type: "POST",
				url: "/meter/json_index.php",
				data: params.data,
				dataType: "json",
				success: function (rows) {
					params.success({
						"rows": rows.items,
						"total": rows.total
					})
				},
				error: function (er) {
					params.error(er);
				}
			});
		}
		
		
		$.fn.bootstrapTable.locales['th-TH'] = {
				formatLoadingMessage () {
						return 'กำลังโหลดข้อมูล, กรุณารอสักครู่'
				},
				formatSearch () {
						return 'ค้นหาจากเลขคำร้อง หรือเบอร์โทร หรือหมายเลขผู้ใช้ไฟ หรือชื่อ-สกุล'
				},
		}
		
		$.extend($.fn.bootstrapTable.defaults, $.fn.bootstrapTable.locales['th-TH']);
		
		$(function() {
		
			$('#table_meter_client').bootstrapTable({
				locale: 'th-TH'
			});
			
		})
		</script>
		
		<!--end::Page Scripts -->
	</body>
	
	<!-- end::Body -->
</html>