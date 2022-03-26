<?php 
	@require_once('config.php');
	@require_once('class/meter.php');
	
	$meter = new Meter();
	
	if (isset($_POST['record_id']) && isset($_POST['token'])) {
		//file_put_contents("log/log.txt", print_r($_POST, true));
		
		$result = $meter->updateMeter($_POST);
		if (!$result['record_id']) {
			print_r($result);
			exit;
		}
		header('location: /document_admin.php');
	}
?>
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
		
		<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
		
		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<style>
		div.filter-control input.form-control {
			padding: 0.2rem;
			font-size: inherit;
		}
		table th.highlight {
			background-color: #fff700;
		}
		.kt-portlet{
			background-color: #ddd;
		}
		.width_120 {
			width: 100px !important;
			min-width: 100px !important;
			padding: 0 !important;
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
										<h3 class="kt-portlet__head-title">แบบที่ 2 กรณีผู้โอนไม่ต้องมาทำการโอนที่ กฟฟ.</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<a href="/export_excel.php" target="_BLANK" class="btn btn-success btn-elevate btn-icon-sm">
												<i class="far fa-file-excel"></i>
												Export EXCEL
											</a>&nbsp;
											<a href="/document.php" target="_BLANK" class="btn btn-brand btn-elevate btn-icon-sm">
												<i class="la la-plus"></i>
												เพิ่มข้อมูล
											</a>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
<?php
	$field_list = $meter->getFullColumns('document_transaction');
?>
								<!--begin: Datatable -->
								<table class="display table table-bordered table-striped" id="table_document" 
									data-sort-name="record_id" 
									data-sort-order="desc"
									data-show-export="true" 
									data-ajax="ajaxRequest" 
									data-side-pagination="server" 
									data-show-columns="true" 
									data-pagination="true" 
									data-filter="true"
									data-remember-order="true"
									data-filter-control="true"
									data-search-on-enter-key="true"
									data-show-search-clear-button="true"
									data-state-save="true"
									data-state-save-id-table="table_document"
									data-cookie="true"
									data-cookie-id-table="table_document">
										<thead>
											<tr>
												<th data-formatter="actionButton" data-switchable="false" class="width_120"></th>
												<th data-field="meter_staff_name">เจ้าหน้าที่ผู้รับคำร้อง</th>
												<th data-field="document_date">วันที่รับคำร้อง</th>
												<th data-field="sap_staff_name">ชื่อผู้ลงระบบ SAP</th>
												<th data-field="sap_date">วันที่ลงระบบ SAP</th>
												<th data-field="due_date">กำหนดรอบบิล</th>
												<th data-field="overdue_debt">หนี้ค้างชำระ</th>
												<th data-field="overdue_date">วันที่ตรวจหนี้ค้าง</th>
<?php
	foreach ($field_list as $field) {
		if (isset($field['Comment']) && $field['Comment']) {
			$field_display = 'false';
			switch ($field['Field']) {
				case 'record_id':
				case 'customer_name':
				case 'tel':
				case 'pea_no':
				case 'customer2_name':
				case 'customer2_email':
				case 'location_name':
				case 'location_address_1':
				case 'location_address_9':
				case 'location_address_10':
				case 'location_address_11':
					$field_display = 'true';
				break;
			}
?>
												<th data-field="<?php echo $field['Field']; ?>" data-visible="<?php echo $field_display; ?>" data-filter-control="input"><?php echo $field['Comment']; ?></th>
<?php } ?>
<?php } ?>
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
		<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
		<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
		<script src="assets/plugins/bootstrap-table/bootstrap-table-cookie.js" type="text/javascript"></script>
		<!--end::Page Vendors -->
		
		<!--begin::Page Scripts(used by this page) -->
		
		<script>
		
		function actionButton(value, row) {
			if (row.document_date) {
				return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" target="_BLANK" href="/document.php?record_id=' + row.record_id + '&token=' + row.token + '"><i class="la la-pencil"></i></a><a class="btn btn-sm btn-clean btn-icon btn-icon-md" onclick="loadModalAJAX(this)" href="javascript:;" url="/modal/document_detail.php?record_id=' + row.record_id + '&token=' + row.token + '"><i class="la la-pencil-square"></i></a><a class="btn btn-sm btn-clean btn-icon btn-icon-md" target="_BLANK" href="/document_print.php?record_id=' + row.record_id + '&token=' + row.token + '"><i class="la la-print"></i></a>';
			} else {
				return '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" target="_BLANK" href="/document.php?record_id=' + row.record_id + '&token=' + row.token + '"><i class="la la-pencil"></i><a class="btn btn-sm btn-clean btn-icon btn-icon-md" onclick="loadModalAJAX(this)" href="javascript:;" url="/modal/document_detail.php?record_id=' + row.record_id + '&token=' + row.token + '"><i class="la la-pencil-square"></i></a>';
			}
		}
			
		function loadModalAJAX(e) {
			var url = $(e).attr('url');
			
			$.ajax({
				url: url,
				type: 'post',
				success: function(response){ 
					// Add response in Modal body
					$('#kt_modal_4_2').html(response);
					
					// Display Modal
					$('#kt_modal_4_2').modal('show'); 
				}
			});
		}
		
		function ajaxRequest(params) {
			$.ajax({
				type: "POST",
				url: "/document_admin_json.php",
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

		
		
		$(function() {
			
			$('#table_document').bootstrapTable({
				onPostHeader: function () {
					$( "input.search-input" ).each(function( i ) {
						if ( $(this).val() ) {
							$(this).closest("th").addClass("highlight");
							} else {
							$(this).closest("th").removeClass("highlight");
						}
					});
				}
			});
			
		})
		</script>
		
		<!--end::Page Scripts -->
	</body>
	
	<!-- end::Body -->
</html>