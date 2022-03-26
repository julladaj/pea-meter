<?php 
	@require_once('config.php');
	@require_once('class/meter.php');
	
	$meter = new Meter();
	
	$record_id = (isset($_GET['record_id']))? $_GET['record_id'] : 0;
	if (isset($_GET['token'])) {
		$token = $_GET['token'];
	} else {
		$token = openssl_random_pseudo_bytes(8);
		//Convert the binary data into hexadecimal representation.
		$token = bin2hex($token);
	}
	
	
	
	if (isset($_POST['record_id']) && isset($_POST['token'])) {
		$result = $meter->updateMeter($_POST);
		if (!$result['record_id']) {
			print_r($result);
			exit;
		}
		header('location: /document.php?record_id=' . $result['record_id'] . '&token=' . $result['token']);
	}
	
	
	
	$data = array();
	if ($record_id && $token) {
		$result = $meter->getMeterDetail($record_id, $token);
		if ($result['total']) $data = $result['items'][0];
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
		<style>
		.kt-portlet{
			background-color: #e2e5ec;
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
		<div class="row">
			<div class="col-md-12">
<?php
	if (isset($_SESSION['error']) && $_SESSION['error']) {
		foreach ($_SESSION['error'] as $error) {
			echo '<div class="alert alert-danger"><strong>Error!</strong> ' . $error . ' </div>';
		}
	}
 $_SESSION['error'] = array();
?>
			</div>
		</div>

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
										<h3 class="kt-portlet__head-title">คำร้องขอรับโอนชื่อผู้ใช้ไฟฟ้า แบบลงข้อมูล</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">

									<form class="kt-form kt-form--label-right" action method="POST">
										<input type="hidden" class="form-control" name="record_id" value="<?php echo $record_id; ?>" />
										<input type="hidden" class="form-control" name="token" value="<?php echo $token; ?>" />
										<div class="form-group form-group-last">
											<div class="alert alert-secondary" role="alert">
												<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
												<div class="alert-text">
													กรุณาบันทึกข้อมูลอย่างต่อเนื่อง เพื่อป้องกันข้อมูลสูญหายระหว่างการกรอก<br />ในช่วงไวรัสแพร่ระบาด ขอให้ผู้ใช้ไฟฟ้าทุกท่านกรอกข้อมูลต่างๆ ผ่านระบบออนไลน์เป็นหลัก เพื่อลดการเดินทาง และสัมผัสกับผู้อื่น อีกทั้งยังเพิ่มความรวดเร็วในการดำเนินการแก่เจ้าหน้าที่
												</div>
											</div>
										</div>
										
										<?php if ($record_id && $token) { ?>
										<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
										<div class="form-group row">
											<label for="example-text-input" class="col-lg-2 col-md-2 col-sm-4 col-form-label">ลิ้งสำหรับแก้ไขข้อมูล:</label>
											<div class="col-lg-10 col-md-10 col-sm-8">
												<a href="<?php echo $actual_link; ?>"><?php echo $actual_link; ?></a>
												<span class="form-text text-muted">โปรดบันทึก URL ข้างต้น เพื่อใช้ในการเข้าแก้ไขข้อมูลเดิมนี้ ในภายหลัง</span>
											</div>
										</div>
										<div class="form-group row">
											<label for="example-text-input" class="col-lg-2 col-md-2 col-sm-4 col-form-label">หมายเลขคำร้องของท่าน:</label>
											<div class="col-lg-10 col-md-10 col-sm-8">
												<span style="font-size:14pt;font-weight:700;">PEA-CM2-<?php echo str_pad($_GET['record_id'], 4, '0', STR_PAD_LEFT); ?></span>
											</div>
										</div>
										<hr />
										<?php } ?>
										
										<div class="form-group row">
											<label for="example-text-input" class="col-lg-2 col-md-2 col-sm-4 col-form-label"></label>
											<div class="col-lg-10 col-md-10 col-sm-8">
												<h1 style="font-size:18pt;font-weight:700;">ลงทะเบียนโอนเปลี่ยนชื่อ<br />ผู้ใช้ไฟฟ้า พื้นที่ PEA-CM2</h1>
												<h2 style="font-size:14pt;font-weight:700;color:red;">การโอนเปลี่ยนชื่อ ในใบเสร็จค่าไฟฟ้าจะเปลี่ยนในรอบบิลเดือนถัดไป</h2>
											</div>
										</div>
										<hr />
										<div class="form-group row">
											<label for="example-text-input" class="col-lg-2 col-md-2 col-sm-4 col-form-label"></label>
											<div class="col-lg-10 col-md-10 col-sm-8">
												<span style="font-size: 1.2rem;font-weight: 500;color: #48465b;">1. ลงทะเบียนโอนเปลี่ยนชื่อผู้ใช้ไฟฟ้า พื้นที่ PEA-CM2</span>
											</div>
										</div>
										<div class="form-group row">
											<label for="example-text-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ผู้ขอรับโอน:</label>
											<div class="col-lg-3 col-md-4 col-sm-8">
												<input type="text" class="form-control" placeholder="ระบุ ชื่อ และ นามสกุล" name="customer_name" value="<?php echo (isset($data['customer_name']))? $data['customer_name'] : ''; ?>" />
												<span class="form-text text-muted">ระบุชื่อและนามสกุลให้ครบถ้วน เพื่อความรวดเร็วแก่เจ้าหน้าที่ และผลประโยชน์ของท่านเอง</span>
											</div>
											<label for="example-text-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">โดย:</label>
											<div class="col-lg-3 col-md-4 col-sm-8">
												<input type="text" class="form-control" placeholder="ระบุ ชื่อ และ นามสกุล" name="customer_name2" value="<?php echo (isset($data['customer_name2']))? $data['customer_name2'] : ''; ?>" />
											</div>
											<label for="example-text-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">สถานะ:</label>
											<div class="col-lg-3 col-md-4 col-sm-8">
												<select class="form-control" name="customer_status">
													<option value="ผู้รับมอบอำนาจ" <?php echo (isset($data['customer_status']) && $data['customer_status'] == 'ผู้รับมอบอำนาจ')? 'selected' : ''; ?>>ผู้รับมอบอำนาจ</option>
													<option value="ผู้ใช้ไฟฟ้า" <?php echo (isset($data['customer_status']) && $data['customer_status'] == 'ผู้ใช้ไฟฟ้า')? 'selected' : ''; ?>>ผู้ใช้ไฟฟ้า</option>
												</select>
											</div>
											<label for="example-text-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">Email:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" placeholder="ระบุ อีเมล์" name="email" value="<?php echo (isset($data['email']))? $data['email'] : ''; ?>" />
												<span class="form-text text-muted">ระบุ อีเมล์ เพื่อให้เจ้าหน้าที่ใช้ในการติดต่อกลับ</span>
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">โทรศัพท์:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" name="tel" value="<?php echo (isset($data['tel']))? $data['tel'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">โทรศัพท์เคลื่อนที่:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" name="mobile" value="<?php echo (isset($data['mobile']))? $data['mobile'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">โทรสาร:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" name="fax" value="<?php echo (isset($data['fax']))? $data['fax'] : ''; ?>" />
											</div>
										</div>
										<div class="form-group row">
											<label for="example-text-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">อายุ:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="number" class="form-control" placeholder="ระบุ อายุ" name="customer_age" value="<?php echo (isset($data['customer_age']))? $data['customer_age'] : ''; ?>" />
											</div>
											<label for="example-text-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">สัญชาติ:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" placeholder="ระบุ สัญชาต" name="customer_nationality" value="<?php echo (isset($data['customer_nationality']))? $data['customer_nationality'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ประเภทบัตร:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" placeholder="ระบุ ประเภทบัตร" name="card_type" value="<?php echo (isset($data['card_type']))? $data['card_type'] : ''; ?>" />
												<span class="form-text text-muted">ตัวอย่างเช่น บัตรประชาชน, บัตรค่าราชการ, ใบขับขี่ เป็นต้น</span>
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">บัตรเลขที่:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" placeholder="ระบุ หมายเลขบนบัตร" name="card_no" value="<?php echo (isset($data['card_no']))? $data['card_no'] : ''; ?>" />
											</div>
										</div>
										<div class="form-group row">
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">รหัสบ้าน:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" placeholder="ระบุ รหัสบ้าน" name="address_code" value="<?php echo (isset($data['address_code']))? $data['address_code'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">บ้านเลขที่:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" placeholder="ระบุ บ้านเลขที่" name="address_1" value="<?php echo (isset($data['address_1']))? $data['address_1'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">หมู่บ้าน/อาคาร:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" name="address_2" value="<?php echo (isset($data['address_2']))? $data['address_2'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ห้อง:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" name="address_3" value="<?php echo (isset($data['address_3']))? $data['address_3'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ชั้น:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" name="address_4" value="<?php echo (isset($data['address_4']))? $data['address_4'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ตรอก:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="address_5" value="<?php echo (isset($data['address_5']))? $data['address_5'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ซอย:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="address_6" value="<?php echo (isset($data['address_6']))? $data['address_6'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ถนน:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="address_7" value="<?php echo (isset($data['address_7']))? $data['address_7'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">หมู่ที่:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="address_8" value="<?php echo (isset($data['address_8']))? $data['address_8'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ตำบล:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="address_9" value="<?php echo (isset($data['address_9']))? $data['address_9'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">อำเภอ:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="address_10" value="<?php echo (isset($data['address_10']))? $data['address_10'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">จังหวัด:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="address_11" value="<?php echo (isset($data['address_11']))? $data['address_11'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">รหัสไปรษณีย์:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="zip_code" value="<?php echo (isset($data['zip_code']))? $data['zip_code'] : ''; ?>" />
											</div>
										</div>
										
										
										
										<hr />
										<div class="form-group row">
											<label for="example-text-input" class="col-lg-2 col-md-2 col-sm-4 col-form-label"></label>
											<div class="col-lg-10 col-md-10 col-sm-8">
												<span style="font-size: 1.2rem;font-weight: 500;color: #48465b;">2. ผู้ใช้เดิม / ชื่อผู้ใช้ไฟฟ้ารายเดิม</span>
											</div>
										</div>
										
										<div class="form-group row">
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ขอรับโอนเครื่องวัดฯ  หมายเลขผู้ใช้ไฟฟ้า:</label>
											<div class="col-lg-3 col-md-4 col-sm-8">
												<input type="text" class="form-control" name="pea_no" value="<?php echo (isset($data['pea_no']))? $data['pea_no'] : ''; ?>" />
												<span class="form-text text-muted">อ้างอิงหมายเลขผู้ใช้ไฟ ได้จากใบเสร็จค่าไฟฟ้าของท่าน</span>
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ในนาม:</label>
											<div class="col-lg-3 col-md-4 col-sm-8">
												<input type="text" class="form-control" name="customer2_name" value="<?php echo (isset($data['customer2_name']))? $data['customer2_name'] : ''; ?>" />
											</div>
										</div>
										<div class="form-group row">
											<div class="col-lg-1 col-md-2 col-sm-4"></div>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<div class="kt-checkbox-inline">
													<label class="kt-checkbox kt-checkbox--solid kt-checkbox--success">
														<input type="checkbox" id="chechbox_same_address" /> ใช้ที่อยู่เดียวกับข้างต้น
														<span></span>
													</label>
												</div>
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ติดตั้งใช้ไฟฟ้าที่  รหัสบ้าน:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" placeholder="ระบุ ที่อยู่รหัสบ้าน" name="location_name" value="<?php echo (isset($data['location_name']))? $data['location_name'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">โฉนดเลขที่:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" placeholder="ระบุ เลขโฉนด" name="land_code" value="<?php echo (isset($data['land_code']))? $data['land_code'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">เลขที่:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" placeholder="ระบุ บ้านเลขที่" name="location_address_1" value="<?php echo (isset($data['location_address_1']))? $data['location_address_1'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">หมู่บ้าน/อาคาร:</label>
											<div class="col-lg-2 col-md-4 col-sm-8">
												<input type="text" class="form-control" name="location_address_2" value="<?php echo (isset($data['location_address_2']))? $data['location_address_2'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ห้อง:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="location_address_3" value="<?php echo (isset($data['location_address_3']))? $data['location_address_3'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ชั้น:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="location_address_4" value="<?php echo (isset($data['location_address_4']))? $data['location_address_4'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ตรอก:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="location_address_5" value="<?php echo (isset($data['location_address_5']))? $data['location_address_5'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ซอย:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="location_address_6" value="<?php echo (isset($data['location_address_6']))? $data['location_address_6'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ถนน:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="location_address_7" value="<?php echo (isset($data['location_address_7']))? $data['location_address_7'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">หมู่ที่:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="location_address_8" value="<?php echo (isset($data['location_address_8']))? $data['location_address_8'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">ตำบล:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="location_address_9" value="<?php echo (isset($data['location_address_9']))? $data['location_address_9'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">อำเภอ:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="location_address_10" value="<?php echo (isset($data['location_address_10']))? $data['location_address_10'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">จังหวัด:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="location_address_11" value="<?php echo (isset($data['location_address_11']))? $data['location_address_11'] : ''; ?>" />
											</div>
											<label for="example-search-input" class="col-lg-1 col-md-2 col-sm-4 col-form-label">รหัสไปรษณีย์:</label>
											<div class="col-lg-2 col-md-4 col-sm-4">
												<input type="text" class="form-control" name="location_zip_code" value="<?php echo (isset($data['location_zip_code']))? $data['location_zip_code'] : ''; ?>" />
											</div>
										</div>
										
										
										
										<hr />
										<div class="form-group row">
											<label for="example-search-input" class="col-lg-2 col-md-2 col-sm-4 col-form-label"></label>
											<div class="col-lg-10 col-md-10 col-sm-8">
												<button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
												<?php if ($record_id && $token) { ?>
												<a href="javascript:window.location.href=window.location.href" class="btn btn-success">คืนค่าตั้งต้น</a>
												<a href="/document.php" class="btn btn-warning" target="_BLANK">เพิ่มข้อมูลใหม่</a>
												<?php } ?>
											</div>
										</div>
									</form>
									
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
								<a href="/" target="_blank" class="kt-footer__menu-link kt-link">About</a>
								<a href="/" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
								<a href="/" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
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
		
		
		<script>
			
			$(document).ready(function() {
				$('#chechbox_same_address').change(function() {
					if (this.checked) {
						//var returnVal = confirm("Are you sure?");
						//$(this).prop("checked", returnVal);

						$('input[name^="location_address_"]').attr('readonly', true);
						$('input[name^="location_address_"]').each(function( index ) {
							
							var e_name = $(this).attr('name');
							//console.log( e_name );
							
							var e2_name = e_name.replace("location_address_", "address_");
							console.log( e2_name );
							
							$(this).val( $('input[name="' + e2_name + '"]').val() );
						});
					} else {
						$('input[name^="location_address_"]').removeAttr('readonly');
					}
				});
			});
			
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