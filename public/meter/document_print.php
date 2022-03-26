<?php
 @require_once('config.php');
	@require_once('class/meter.php');
	
	$meter = new Meter();
 
 if (!isset($_GET['record_id']) || !isset($_GET['token'])) die();
	
	$data = array();
	$result = $meter->getMeterDetail($_GET['record_id'], $_GET['token']);
	if ($result['total']) $data = $result['items'][0];
	else die();
	
	$month_no = (int)date("n", strtotime($data['document_date'])) - 1;
	$month_th = array(
		'มกราคม',
		'กุมภาพันธ์',
		'มีนาคม',
		'เมษายน',
		'พฤษภาคม',
		'มิถุนายน',
		'กรกฎาคม',
		'สิงหาคม',
		'กันยายน',
		'ตุลาคม',
		'พฤษจิกายน',
		'ธันวาคม'
	);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
 <!--<![endif]-->
 <!-- BEGIN HEAD -->
 <head>
		<base href="theme/default/demo1/dist/" />
		<meta charset="utf-8" />
		<title>การไฟฟ้าส่วนภูมิภาค</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
		
		<!--begin::Fonts -->
		<!--end::Fonts -->
		
		<!--begin::Page Vendors Styles(used by this page) -->
		<!--end::Page Vendors Styles -->
		
		<!--begin::Global Theme Styles(used by all pages) -->
		<!--end::Global Theme Styles -->
		
		<!--begin::Layout Skins(used by all pages) -->
		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/report.css" rel="stylesheet" type="text/css" />
		
		<style>
html,body {
	margin: 0;
}

@page {
	size: A4;
	margin: 0;
}

@media print {
	.page {
		margin: 0;
		border: initial;
		border-radius: initial;
		width: initial;
		min-height: initial;
		box-shadow: initial;
		background: initial;
		page-break-after: always;
	}
	
	div.page_break {
		page-break-before: always;
	}
}

table td {padding-left:5px;padding-right: 5px;}
thead {display: table-header-group;}
tfoot {display: table-footer-group;}

.underline {
	border-bottom: 1px dotted #000!important;
}
.left {
	text-align: left;
}
.right {
	text-align: right;
}
.center {
	text-align: center;
}
.top {
	vertical-align: top;
}

table.u {
	width:100%;
	margin-top:8px;
}
span.u {
	padding:0 20px;
	font-weight: bold;
}
td.signed:before {
	content: "(";
}
td.signed:after {
	content: ")";
}
div.u:before {
	content: "(";
	position: absolute;
	left: 0;
}
div.u:after {
	content: ")";
	position: absolute;
	right: 0;
}
div.u {
	border-bottom: 1px dotted #000!important;
	width: 100%;
}
		</style>
	</head>
		
 <!-- END HEAD -->
 <body>
		<div class="page">
		<table style="width:210mm;height:297mm;font-size:12px;table-layout: fixed;" border="1">
			<thead>
			<tr style="height:58px;">
				<td colspan="3" class="left top" style="padding:10px;border-right: 0px;"><img src="assets/media/logos/pea.jpg" /></td>
				<td colspan="4" class="left top" style="padding:10px;border-left: 0px;font-size:12px;"><b>การไฟฟ้าส่วนภูมิภาค</b><br /><span style="font-size:12px;">200 ถนนงามวงศ์วาน จตุจักร กรุงเทพฯ 10900<br />คำร้องรับโอนชื่อผู้ใช้ไฟฟ้า</span><br /><b>แบบที่ 2 กรณีผู้โอนไม่ต้องมาทำการโอนที่ กฟฟ.</b></td>
				<td colspan="7" class="left top">
					<table class="u"><tr><td style="width:70px;">เลขที่คำร้อง</td><td class="underline"></td></tr></table>
					<table class="u"><tr><td style="width:30px;">กฟฟ.</td><td class="underline"><span class="u">กฟจ.เชียงใหม่2</span></td></tr></table>
					<table class="u"><tr><td style="width:110px;">เจ้าหน้าที่ผู้รับคำร้อง</td><td class="underline"><span class="u"><?php echo $data['meter_staff_name']; ?></span></td></tr></table>
					<table class="u"><tr><td style="width:35px;">วันที่</td><td class="underline"><span class="u"><?php echo date("d", strtotime($data['document_date'])); ?></span></td><td class="center" style="width:40px;">เดือน</td><td class="underline"><span class="u"><?php echo $month_th[$month_no]; ?></span></td><td class="center" style="width:35px;">พ.ศ.</td><td class="underline"><span class="u"><?php echo date("Y", strtotime($data['document_date'])) + 543; ?></td></tr></table>
				</td>
			</tr>
			</thead>
			<tbody>
			<tr style="height:58px;">
				<td colspan="14" class="left top" style="padding:10px;border-bottom: 0px;">
					<table class="u"><tr>
						<td style="width:90px;"><span style="padding-left:40px;">&nbsp;</span>ข้าพเจ้า</td>
						<td class="underline"><span class="u"><?php echo $data['customer_name']; ?></span></td>
						<td class="center" style="width:40px;">อายุ</td>
						<td class="underline"><span class="u"><?php echo $data['customer_age']; ?></span></td>
						<td class="center" style="width:70px;">ปี   สัญชาติ</td>
						<td class="underline"><span class="u"><?php echo $data['customer_nationality']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:75px;">ประเภทบัตร</td>
						<td class="underline"><span class="u"><?php echo $data['card_type']; ?></span></td>
						<td class="center" style="width:45px;">เลขที่</td>
						<td class="underline"><span class="u"><?php echo $data['card_no']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:85px;">ที่อยู่ รหัสบ้าน </td>
						<td class="underline"><span class="u"><?php echo $data['address_code']; ?></span></td>
						<td style="width:40px;">เลขที่</td>
						<td class="underline"><span class="u"><?php echo $data['address_1']; ?></span></td>
						<td class="center" style="width:90px;">หมู่บ้าน/อาคาร</td>
						<td class="underline"><span class="u"><?php echo $data['address_2']; ?></span></td>
						<td class="center" style="width:30px;">ห้อง</td>
						<td class="underline"><span class="u"><?php echo $data['address_3']; ?></span></td>
						<td class="center" style="width:30px;">ชั้น</td>
						<td class="underline"><span class="u"><?php echo $data['address_4']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:35px;">ตรอก</td>
						<td class="underline"><span class="u"><?php echo $data['address_5']; ?></span></td>
						<td class="center" style="width:40px;">ซอย</td>
						<td class="underline"><span class="u"><?php echo $data['address_6']; ?></span></td>
						<td class="center" style="width:35px;">ถนน</td>
						<td class="underline"><span class="u"><?php echo $data['address_7']; ?></span></td>
						<td class="center" style="width:40px;">หมู่ที่</td>
						<td class="underline"><span class="u"><?php echo $data['address_8']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:40px;">ตำบล</td>
						<td class="underline"><span class="u"><?php echo $data['address_9']; ?></span></td>
						<td class="center" style="width:45px;">อำเภอ</td>
						<td class="underline"><span class="u"><?php echo $data['address_10']; ?></span></td>
						<td class="center" style="width:60px;">จังหวัด</td>
						<td class="underline"><span class="u"><?php echo $data['address_11']; ?></span></td>
						<td class="center" style="width:85px;">รหัสไปรษณีย์</td>
						<td class="underline"><span class="u"><?php echo $data['zip_code']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:55px;">โทรศัพท์</td>
						<td class="underline"><span class="u"><?php echo $data['tel']; ?></span></td>
						<td class="center" style="width:55px;">โทรสาร</td>
						<td class="underline"><span class="u"><?php echo $data['fax']; ?></span></td>
						<td class="center" style="width:55px;">E-mail</td>
						<td class="underline"><span class="u"><?php echo $data['email']; ?></span></td>
					</tr></table>
				</td>
			</tr>
			<tr style="height:58px;">
				<td colspan="14" class="left top" style="padding:10px;border-top: 0px;border-bottom: 0px;">
					<table class="u"><tr>
						<td style="width:320px;"><span style="padding-left:40px;">&nbsp;</span>ขอรับโอนชื่อผู้ใช้ไฟฟ้าเครื่องวัดฯ  หมายเลขผู้ใช้ไฟฟ้า</td>
						<td class="underline"><span class="u"><?php echo $data['pea_no']; ?></span></td>
						<td class="center" style="width:50px;">ในนาม</td>
						<td class="underline"><span class="u"><?php echo $data['customer2_name']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:85px;">ประกอบกิจการ</td>
						<td class="underline"><span class="u"><?php echo $data['customer_type']; ?></span></td>
						<td class="center" style="width:70px;">โฉนดเลขที่</td>
						<td class="underline"><span class="u"><?php echo $data['land_code']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:140px;">ติดตั้งใช้ไฟฟ้าที่  รหัสบ้าน</td>
						<td class="underline"><span class="u"><?php echo $data['location_name']; ?></span></td>
						<td class="center" style="width:40px;">เลขที่</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_1']; ?></span></td>
						<td class="center" style="width:90px;">หมู่บ้าน/อาคาร</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_2']; ?></span></td>
						<td class="center" style="width:30px;">ห้อง</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_3']; ?></span></td>
						<td class="center" style="width:30px;">ชั้น</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_4']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:35px;">ตรอก</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_5']; ?></span></td>
						<td class="center" style="width:40px;">ซอย</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_6']; ?></span></td>
						<td class="center" style="width:35px;">ถนน</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_7']; ?></span></td>
						<td class="center" style="width:40px;">หมู่ที่</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_8']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:40px;">ตำบล</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_9']; ?></span></td>
						<td class="center" style="width:45px;">อำเภอ</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_10']; ?></span></td>
						<td class="center" style="width:60px;">จังหวัด</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_11']; ?></span></td>
						<td class="center" style="width:85px;">รหัสไปรษณีย์</td>
						<td class="underline"><span class="u"><?php echo $data['location_zip_code']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:55px;">โทรศัพท์</td>
						<td class="underline"><span class="u"><?php echo $data['tel']; ?></span></td>
						<td class="center" style="width:55px;">โทรสาร</td>
						<td class="underline"><span class="u"><?php echo $data['fax']; ?></span></td>
						<td class="center" style="width:55px;">E-mail</td>
						<td class="underline"><span class="u"><?php echo $data['email']; ?></span></td>
					</tr></table>
				</td>
			</tr>
			<tr style="height:8px;">
				<td colspan="14" class="left top" style="padding:10px;border-top: 0px;border-bottom: 0px;">
					<span style="padding-left:40px;">&nbsp;</span>ซึ่งในขณะนี้ข้าพเจ้าเป็นเจ้าของบ้านดังกล่าวถูกต้องตามกฎหมาย  หากมีผู้ใดโต้แย้งสิทธิภายหลังการโอนนี้ ข้าพเจ้าผู้รับโอนยอมรับผิดชอบในความเสียหายใด ๆ อันจะเกิดมีขึ้นและขอสัญญาว่ายินยอมชำระค่าไฟฟ้าเดิมค้างชำระต่อการไฟฟ้าส่วนภูมิภาคให้เสร็จสิ้นก่อนที่จะมีการโอนให้ต่อไป<br />
					<span style="padding-left:40px;">&nbsp;</span>เพื่อเป็นหลักฐาน ข้าพเจ้าผู้รับโอนได้ลงลายมือชื่อไว้เป็นสำคัญ  ต่อหน้าพยานที่มีนามข้างท้ายนี้
				</td>
			</tr>
			<tr>
				<td colspan="8" style="border-right: 0px;border-top: 0px;border-bottom: 0px;"></td>
				<td colspan="6" style="border-left: 0px;border-top: 0px;border-bottom: 0px;">
					<table class="u"><tr>
						<td style="width:40px;">ลงชื่อ</td>
						<td class="underline center"><span class="u"></span></td>
						<td style="width:55px;">ผู้รับโอน</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:40px;"></td>
						<td class="center" style="position:relative;"><div class="u"><?php echo $data['customer_name2']; ?></div></td>
						<td style="width:55px;"></td>
					</tr></table>
				</td>
			</tr>
			<tr>
				<td colspan="8" style="border-right: 0px;border-top: 0px;border-bottom: 0px;"></td>
				<td colspan="6" style="border-left: 0px;border-top: 0px;border-bottom: 0px;">
					<table class="u"><tr>
						<td style="width:40px;">ลงชื่อ</td>
						<td class="underline center"><span class="u"></span></td>
						<td style="width:55px;">พยาน</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:40px;"></td>
						<td class="underline center">&nbsp;</td>
						<td style="width:55px;"></td>
					</tr></table>
				</td>
			</tr>
			<tr>
				<td colspan="8" style="border-right: 0px;border-top: 0px;border-bottom: 0px;"></td>
				<td colspan="6" style="border-left: 0px;border-top: 0px;border-bottom: 0px;">
					<table class="u"><tr>
						<td style="width:40px;">ลงชื่อ</td>
						<td class="underline center"><span class="u"></span></td>
						<td style="width:55px;">พยาน</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:40px;"></td>
						<td class="underline center">&nbsp;</td>
						<td style="width:55px;"></td>
					</tr></table>
				</td>
			</tr>
			</tbody>
			<tfoot>
			<tr>
				<td colspan="7">
					<table class="u"><tr><td style="width:70px;">เรียน ผจก.</td><td class="underline"><span class="u">กฟจ.เชียงใหม่2</span></td></tr></table>
					<br />เพื่อโปรดอนุมัติโอนเปลี่ยนชื่อมิเตอร์เลขที่<br />
					<table class="u"><tr><td style="width:55px;">PEA.NO</td><td class="underline"><span class="u"><?php echo $data['pea_no']; ?></span></td></tr></table>
					<table class="u"><tr><td style="width:40px;">ขนาด</td><td class="underline"><span class="u"><?php echo (isset($data['meter_amp']))? $data['meter_amp'] . 'A' : ''; ?>&nbsp;<?php echo (isset($data['meter_phase']))? $data['meter_phase'] . 'P' : ''; ?></span></td></tr></table>
					<br />
					<table class="u"><tr>
						<td class="right" style="width:90px;">ลงชื่อ</td>
						<td class="underline center">&nbsp;</td>
						<td style="width:90px;">&nbsp;</td>
					</tr></table>
					<table class="u"><tr>
						<td class="right" style="width:90px;">&nbsp;</td>
						<td class="center" style="position:relative;"><div class="u"><?php echo $data['meter_staff_name']; ?></div></td>
						<td style="width:90px;">&nbsp;</td>
					</tr></table>
					<table class="u"><tr>
						<td class="right" style="width:90px;">ตำแหน่ง</td>
						<td class="underline center"><span class="u"><?php echo $data['meter_staff_position']; ?></span></td>
						<td style="width:90px;">&nbsp;</td>
					</tr></table>
					<br />
				</td>
				<td colspan="7">
					หลักฐานที่ต้องนำมาแสดง
					<ol>
						<li>บัตรประจำตัวของผู้รับโอน</li>
						<li>สำเนาทะเบียนบ้านที่ติดตั้งการใช้ไฟฟ้าของผู้รับโอน</li>
						<li>สำเนาใบมรณะบัตรของผู้ใช้ไฟฟ้า (กรณีผู้ขอใช้ไฟฟ้าถึงแก่ความตาย)</li>
						<li>สำเนาสัญญาซื้อขายไฟฟ้า (กรณีที่มีการซื้อขายบ้าน)</li>
						<li>ใบเสร็จค่าไฟฟ้าครั้งสุดท้ายของผู้โอน</li>
						<li>ใบเสร็จรับเงินค่าประกันการใช้ไฟฟ้าของผู้โอน</li>
						<li>หลักฐานอื่น ๆ ที่จำเป็น</li>
					</ol>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="border-right: 0px;"></td>
				<td class="center" colspan="6" style="border-left: 0px;border-right: 0px;">
					<br /><span class="u">อนุมัติ</span><br /><br />
					<table class="u"><tr>
						<td class="underline center">&nbsp;<img style="position:absolute;height: 120px;margin: -60px;" src="assets/media/users/signed.png" /></td>
					</tr></table>
					<table class="u"><tr>
						<td class="signed center"><span class="u underline">นายศุภชัย   พันติ</span></td>
					</tr></table>
					<table class="u"><tr>
						<td class="underline center"><span class="u">หผ.บค.กฟจ.ชม2 ปฏิบัติงานแทน  ผจก.กฟจ.ชม.2</span></td>
					</tr></table>
					<br />
				</td>
				<td colspan="4" style="border-left: 0px;"></td>
			</tr>
			</tfoot>
		</table>
		</div>

		
		<div class="page">
		<table style="width:210mm;height:297mm;font-size:12px;table-layout: fixed;" border="0">
			<thead>
			<tr >
				<td colspan="14">&nbsp;</td>
				</td>
			</tr>
			<tr style="height:8px;padding-top:10px;">
				<td colspan="2" class="left top" style="padding:10px;">คำร้องเลขที่</td>
				<td colspan="4" class="left top" style="border: 1px solid #000!important;">&nbsp;</td>
				<td colspan="8" class="left top">
				</td>
			</tr>
			<tr style="height:8px;padding-top:10px;">
				<td colspan="14" class="center top"><img style="width:150px;" src="assets/media/logos/pea_logo2.png" /></td>
				</td>
			</tr>
			<tr style="height:8px;padding-top:10px;">
				<td colspan="14" class="center top" style="font-weight:700;font-size:14pt;padding-top:20px;padding-bottom:20px;">สัญญาซื้อขายไฟฟ้า</td>
				</td>
			</tr>
			</thead>
			<tbody>
			<tr style="height:8px;">
				<td colspan="14" class="left top" style="padding:10px;border-bottom: 0px;">
					<table class="u"><tr>
						<td style="width:125px;"><span style="padding-left:40px;">&nbsp;</span>สัญญาเลขที่</td>
						<td class="underline"><span class="u">&nbsp;</span></td>
						<td class="center" style="width:40px;">ทำที่</td>
						<td class="underline"><span class="u">การไฟฟ้าส่วนภูมิภาค จังหวัดเชียงใหม่ 2</span></td>
					</tr></table>
				</td>
			</tr>
			<tr style="height:38px;">
				<td colspan="4" class="left top"></td>
				<td colspan="8" class="left top">
					<table class="u"><tr><td style="width:35px;">วันที่</td><td class="underline"><span class="u"><?php echo date("d", strtotime($data['document_date'])); ?></span></td><td class="center" style="width:40px;">เดือน</td><td class="underline"><span class="u"><?php echo $month_th[$month_no]; ?></span></td><td class="center" style="width:35px;">พ.ศ.</td><td class="underline"><span class="u"><?php echo date("Y", strtotime($data['document_date'])) + 543; ?></td></tr></table>
				</td>
				<td colspan="2" class="left top"></td>
			</tr>
			<tr style="height:8px;">
				<td colspan="14" class="left top" style="padding:10px;">
					<table class="u"><tr>
						<td style="width:300px;"><span style="padding-left:40px;">&nbsp;</span>สัญญานี้ทำขึ้นระหว่างการไฟฟ้าส่วนภูมิภาค โดย</td>
						<td class="underline"><span class="u">นายศุชัย พันติ&nbsp;&nbsp;|&nbsp;&nbsp;หัวหน้าแผนกบริการลูกค้า ผู้รับมอบอำนาจช่วง</span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:205px;">สำนักงานตั้งอยู่เลขที่</td>
						<td class="underline"><span class="u">ชั้น 1.2</span></td>
						<td class="center" style="width:40px;">ซอย</td>
						<td class="underline"><span class="u">&nbsp;</span></td>
						<td class="center" style="width:40px;">ถนน</td>
						<td class="underline"><span class="u">&nbsp;</span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:80px;">แขวง/ตำบล</td>
						<td class="underline"><span class="u">ช้างเผือก</span></td>
						<td class="center" style="width:75px;">เขต/อำเภอ</td>
						<td class="underline"><span class="u">เมืองเชียงใหม่</span></td>
						<td class="center" style="width:60px;">จังหวัด</td>
						<td class="underline"><span class="u">เชียงใหม่</span></td>
						<td class="center" style="width:80px;">รหัสไปรษณีย์</td>
						<td class="underline"><span class="u">50300</span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:270px;">ซึ่งต่อไปนี้ในสัญญาจะเรียกว่า “ผู้ขาย” ฝ่ายหนึ่ง กับ</td>
						<td class="underline"><span class="u"><?php echo $data['customer_name']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:40px;">โดย</td>
						<td class="underline"><span class="u"><?php echo $data['customer_name2']; ?></span></td>
						<td class="center" style="width:130px;"><?php echo $data['customer_status']; ?> อายุ</td>
						<td class="underline"><span class="u"><?php echo $data['customer_age']; ?></span></td>
						<td class="right" style="width:140px;">ปี เลขประจำตัวประชาชน/</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:130px;">ทะเบียนนิติบุคคล เลขที่</td>
						<td class="underline"><span class="u"><?php echo $data['card_no']; ?></span></td>
						<td class="center" style="width:80px;">อยู่บ้านเลขที่</td>
						<td class="underline"><span class="u"><?php echo $data['address_1']; ?></span></td>
						<td class="center" style="width:40px;">หมู่ที่</td>
						<td class="underline"><span class="u"><?php echo $data['address_8']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:90px;">หมู่บ้าน/อาคาร</td>
						<td class="underline"><span class="u"><?php echo $data['address_2']; ?></span></td>
						<td class="center" style="width:40px;">ห้อง</td>
						<td class="underline"><span class="u"><?php echo $data['address_3']; ?></span></td>
						<td class="center" style="width:40px;">ชั้น</td>
						<td class="underline"><span class="u"><?php echo $data['address_4']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:70px;">ตรอก/ซอย</td>
						<td class="underline"><span class="u"><?php echo $data['address_5']; ?></span></td>
						<td class="center" style="width:40px;">ถนน</td>
						<td class="underline"><span class="u"><?php echo $data['address_7']; ?></span></td>
						<td class="center" style="width:80px;">แขวง/ตำบล</td>
						<td class="underline"><span class="u"><?php echo $data['address_9']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:70px;">เขต/อำเภอ</td>
						<td class="underline"><span class="u"><?php echo $data['address_10']; ?></span></td>
						<td class="center" style="width:55px;">จังหวัด</td>
						<td class="underline"><span class="u"><?php echo $data['address_11']; ?></span></td>
						<td class="right" style="width:200px;">ซึ่งต่อไปนี้ในสัญญาจะเรียกว่า “ผู้ซื้อ”</td>
					</tr></table>
					<table class="u"><tr>
						<td>อีกฝ่ายหนึ่ง</td>
					</tr></table>
				</td>
			</tr>
			<tr style="height:8px;">
				<td colspan="14" class="left top" style="padding:10px;">
					<table class="u"><tr>
						<td><b>1. ข้อตกลงซื้อขายไฟฟ้า</b></td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>1.1 ผู้ซื้อตกลงซื้อและผู้ขายตกลงขายไฟฟ้า โดยจะจ่ายไฟฟ้าให้ผู้ซื้อผ่านมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าหรือผ่านการบรรจบไฟฟ้า</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:45px;">ขนาด</td>
						<td class="underline"><span class="u"><?php echo $data['meter_amp']; ?></span></td>
						<td class="center" style="width:50px;">แอมป์</td>
						<td class="underline"><span class="u"><?php echo $data['meter_phase']; ?></span></td>
						<td class="center" style="width:35px;">เฟส</td>
						<td class="underline"><span class="u"><?php echo $data['meter_kva']; ?></span></td>
						<td class="center" style="width:170px;">เควีเอ ซึ่งเป็นผู้ใช้ไฟฟ้าประเภท</td>
						<td class="underline"><span class="u"><?php echo $data['customer_type']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:80px;">ณ บ้านเลขที่</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_1']; ?></span></td>
						<td style="width:90px;">หมู่บ้าน/อาคาร</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_2']; ?></span></td>
						<td class="center" style="width:40px;">ห้อง</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_3']; ?></span></td>
						<td class="center" style="width:40px;">ชั้น</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_4']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:70px;">ตรอก/ซอย</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_5']; ?></span></td>
						<td class="center" style="width:40px;">ถนน</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_7']; ?></span></td>
						<td class="center" style="width:80px;">แขวง/ตำบล</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_9']; ?></span></td>
					</tr></table>
					
					<table class="u"><tr>
						<td style="width:70px;">เขต/อำเภอ</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_10']; ?></span></td>
						<td class="center" style="width:35px;">จังหวัด</td>
						<td class="underline"><span class="u"><?php echo $data['location_address_11']; ?></span></td>
						<td class="center" style="width:85px;">รหัสไปรษณีย์</td>
						<td class="underline"><span class="u"><?php echo $data['zip_code']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:60px;">โทรศัพท์</td>
						<td class="underline"><span class="u"><?php echo $data['tel']; ?></span></td>
						<td class="center" style="width:100px;">โทรศัพท์เคลื่อนที่</td>
						<td class="underline"><span class="u"><?php echo $data['tel']; ?></span></td>
						<td class="center" style="width:35px;">โทรสาร</td>
						<td class="underline"><span class="u"><?php echo $data['fax']; ?></span></td>
					</tr></table>
					<table class="u"><tr>
						<td>สัญญาฉบับนี้มีผลใช้บังคับตั้งแต่วันที่ทั้งสองฝ่ายได้ลงนามในสัญญาเป็นต้นไป</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>1.2 ผู้ซื้อต้องให้ข้อมูลที่ถูกต้อง ครบถ้วนตามความเป็นจริงแก่ผู้ขายเพื่อจัดทำสัญญานี้ และผู้ขายจะขอให้ผู้ซื้อให้ข้อมูลส่วนบุคคลเกินจำเป็นมิได้ เว้นแต่ผู้ขายได้แจ้งวัตถุประสงค์ของการขอข้อมูลดังกล่าวให้แก่ ผู้ซื้อทราบ และผู้ซื้อได้ให้ความยินยอมโดยชัดแจ้ง</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>1.3 ผู้ขายมีหน้าที่เก็บข้อมูลของผู้ซื้อเป็นความลับและไม่นำไปใช้เพื่อประโยชน์อื่น เว้นแต่เป็นการใช้เพื่อประโยชน์ตามกฎหมาย</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>1.4 ผู้ขายมีหน้าที่ให้บริการไฟฟ้าไม่ต่ำกว่ามาตรฐานทางวิศวกรรมในการประกอบกิจการไฟฟ้า และมาตรฐานคุณภาพการให้บริการในการประกอบกิจการไฟฟ้า</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>กรณีเกิดเหตุขัดข้องกับการให้บริการไฟฟ้าจนเป็นเหตุให้ผู้ซื้อไม่สามารถใช้ไฟฟ้าได้ตามปกติ ผู้ขาย มีหน้าที่ต้องดำเนินการแก้ไขให้ใช้บริการได้ภายในกำหนดระยะเวลาตามมาตรฐานคุณภาพการให้บริการในการประกอบกิจการไฟฟ้า</td>
					</tr></table>
				</td>
			</tr>
			<tr>
				<td colspan="14" class="left top" style="padding:10px;">&nbsp;</td>
			</tr>
			</tbody>
			<tfoot>
			<tr style="height:58px;">
				<td colspan="1">&nbsp;</td>
				<td colspan="6">
					<table class="u"><tr>
						<td style="width:70px;">(ลายมือชื่อ)</td>
						<td class="underline center">&nbsp;<img style="position:absolute;height: 120px;margin: -80px 0 0 -60px;" src="assets/media/users/signed.png" /></td>
						<td class="right" style="width:40px;">ผู้ขาย</td>
					</tr></table>
				</td>
				<td colspan="1">&nbsp;</td>
				<td colspan="6">
					<table class="u"><tr>
						<td style="width:70px;">(ลายมือชื่อ)</td>
						<td class="underline"><span class="u"></span></td>
						<td class="right" style="width:35px;">ผู้ซื้อ</td>
					</tr></table>
				</td>
			</tr>
			</tfoot>
		</table>
		</div>
		
		<div class="page">
		<table style="width:210mm;height:297mm;font-size:12px;table-layout: fixed;" border="0">
			<thead>
			<tr >
				<td colspan="14">&nbsp;</td>
				</td>
			</tr>
			<tr style="height:8px;padding-top:10px;">
				<td colspan="2" class="left top" style="padding:10px;">คำร้องเลขที่</td>
				<td colspan="4" class="left top" style="border: 1px solid #000!important;">&nbsp;</td>
				<td colspan="8" class="left top">
				</td>
			</tr>
			</thead>
			<tbody>
			<tr style="height:28px;">
				<td colspan="14" class="left top">&nbsp;</td>
			</tr>
			<tr style="height:8px;">
				<td colspan="14" class="left top" style="padding:10px;">
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>กรณีเกิดเหตุขัดข้องอันเนื่องจากเหตุสุดวิสัย ผู้ขายจะรีบแจ้งให้ผู้ซื้อทราบโดยไม่ชักช้าถึงเหตุขัดข้อง ผลกระทบและระยะเวลาในการแก้ไขปัญหาจากเหตุดังกล่าว</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>“เหตุสุดวิสัย” หมายความว่า เหตุใด ๆ อันจะเกิดขึ้นก็ดี จะให้ผลพิบัติก็ดี เป็นเหตุที่ไม่อาจป้องกันได้ แม้ทั้งบุคคลผู้ต้องประสบหรือใกล้จะต้องประสบเหตุนั้น จะได้จัดการระมัดระวังตามสมควรอันพึงคาดหมายได้จากบุคคลในฐานะและภาวะเช่นนั้น</td>
					</tr></table>
					<table class="u"><tr>
						<td><b>2. ชนิดและขอบเขตการซื้อขาย</b></td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>2.1 ผู้ขาย เป็นผู้กำหนดคุณลักษณะ ความถี่ ระบบแรงดันไฟฟ้า และขนาดการใช้ไฟฟ้า เพื่อความมั่นคงในระบบจำหน่ายไฟฟ้าหรือระบบจ่ายไฟฟ้า</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>2.2 ผู้ขายเป็นผู้กำหนดขนาด คุณลักษณะ จำนวน และตำแหน่งที่จะติดตั้งมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าตามมาตรฐานของผู้ขาย เพื่อความสะดวกในการจดหน่วยไฟฟ้า การตรวจสอบ การเปลี่ยนแปลงแก้ไข การซ่อมและการบำรุงรักษา</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>2.3 หากผู้ซื้อใช้ไฟฟ้าเกินขนาด ตามที่ผู้ขายกำหนดไว้ในข้อ 2.1 หรือข้อ 2.2 ผู้ซื้อมีหน้าที่ต้องขอเพิ่มขนาดมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าให้เพียงพอกับขนาดการใช้ไฟฟ้า ในกรณีที่ผู้ขายแจ้งให้ผู้ซื้อขอเพิ่มขนาดมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้า แต่ผู้ซื้อไม่มาติดต่อขอเพิ่มพร้อมชำระค่าบริการภายในวันเวลาที่กำหนด ผู้ขายมีอำนาจในการดำเนินการเพื่อให้เกิดความปลอดภัยของผู้ซื้อ และผู้ซื้อต้องรับผิดชอบค่าใช้จ่ายต่าง ๆ รวมทั้งค่าเสียหายที่อาจเกิดขึ้น</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>2.4 กรณีที่ผู้ซื้อมีความประสงค์ที่จะใช้เครื่องกำเนิดไฟฟ้าของตนเองหรือติดตั้งเครื่องกำเนิดไฟฟ้าสำรอง ต่อขนานเข้ากับระบบจำหน่ายไฟฟ้าหรือระบบจ่ายไฟฟ้าของผู้ขาย ผู้ซื้อต้องแจ้งความประสงค์ให้ผู้ขายทราบ และจะต้องได้รับอนุญาตเป็นหนังสือ และหรือทำสัญญาจากผู้ขายก่อนทุกครั้ง ทั้งนี้ เพื่อป้องกันมิให้เกิดอันตรายและความเสียหายแก่ระบบจำหน่ายไฟฟ้าหรือระบบจ่ายไฟฟ้าของผู้ขาย และรบกวนการใช้ไฟฟ้าของผู้ซื้อรายอื่น หากผู้ซื้อไม่แจ้งและหรือได้รับอนุญาตเป็นหนังสือจากผู้ขายก่อนดำเนินการ เมื่อเกิด ความเสียหายต่อ ผู้ขาย หรือ ผู้ซื้อรายอื่นๆ หรือบุคคลอื่น ผู้ซื้อต้องยินยอมรับผิดชอบและชำระค่าเสียหายเนื่องจากเหตุดังกล่าว</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>2.5 กรณีที่ผู้ขายเห็นเป็นการจำเป็น หรือสมควรจะหยุด หรือลดการส่งพลังงานไฟฟ้า เพื่อปฏิบัติงานตามแผนเป็นการชั่วคราว ผู้ขายจะแจ้งวันเวลาดับไฟฟ้าให้แก่ผู้ซื้อทราบทางสื่อมวลชน หรือเครื่องขยายเสียง หรือปิดประกาศ ให้ทราบล่วงหน้าอย่างน้อย 3 (สาม) วันทำการก่อนการดับไฟหรือเป็นไปตามระยะเวลาที่กำหนดไว้ในมาตรฐานคุณภาพการให้บริการที่ผู้ขายประกาศใช้ในขณะนั้น เว้นแต่ในกรณีฉุกเฉิน</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>2.6 ผู้ซื้อจะปฏิบัติตามข้อบังคับ ระเบียบ คำสั่ง หลักเกณฑ์ วิธีปฏิบัติ และประกาศของผู้ขายที่เกี่ยวกับการใช้ไฟฟ้าทุกประการ และที่เปลี่ยนแปลงแก้ไขหรือตราขึ้นใหม่ และให้แสดง ณ ที่ทำการของผู้ขาย</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>2.7 ในกรณีที่ผู้ซื้อของดใช้ไฟฟ้าเป็นการชั่วคราวหรือบอกเลิกการใช้ไฟฟ้า ผู้ขายอาจไม่ดำเนินการให้ตามที่ผู้ซื้อร้องขอก็ได้ หากปรากฏว่ามีผู้ครอบครองสถานที่ใช้ไฟฟ้ายืนยันเป็นหนังสือตามแบบที่ผู้ขายกำหนดว่าต้องการใช้ไฟฟ้าต่อไป</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>2.8 ผู้ขายสงวนสิทธิงดจ่ายไฟฟ้าให้แก่ผู้ซื้อ เมื่อปรากฏว่าการใช้ไฟฟ้าของผู้ซื้อรบกวนการใช้ไฟฟ้าของรายอื่น เช่น ทำให้แรงดันตก แรงดันกระเพื่อม ไฟฟ้าดับ ไฟฟ้าดับชั่วขณะ(ไฟกะพริบ) หรือสร้างความถี่รบกวนการใช้ไฟฟ้า ฯลฯ ซึ่งหากมีความเสียหายเกิดขึ้นไม่ว่ากรณีใดๆ ผู้ซื้อต้องรับผิดชอบในความเสียหายนั้น</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>2.9 ผู้ซื้อทราบดีว่า โดยสภาพไฟฟ้าเป็นทรัพย์ที่อาจเกิดอันตรายได้และต้องใช้ความระมัดระวัง ผู้ซื้อจะต้องเดินสายไฟฟ้าและติดตั้งอุปกรณ์ไฟฟ้าในส่วนที่เป็นอุปกรณ์ไฟฟ้าภายในของผู้ซื้อให้เป็นไปตามกฎ หรือระเบียบ และมาตรฐานที่ผู้ขายกำหนดหรือเห็นชอบ เพื่อความปลอดภัยในการใช้ไฟฟ้า</td>
					</tr></table>
					<table class="u"><tr>
						<td><b>3. อัตราค่าไฟฟ้า</b></td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>3.1 อัตราค่าไฟฟ้าและค่าบริการที่ซื้อขายกันตามสัญญานี้ เป็นไปตามอัตราที่คณะกรรมการกำกับกิจการพลังงานพิจารณาให้ความเห็นชอบและผู้ขายประกาศใช้อยู่ในขณะนั้นๆ</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>3.2 การเปลี่ยนแปลงอัตราค่าไฟฟ้าและค่าบริการ ผู้ขายจะดำเนินการได้เมื่อได้รับความเห็นชอบจากคณะกรรมการกำกับกิจการพลังงาน โดยผู้ขายจะประกาศให้ผู้ซื้อทราบล่วงหน้า</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>3.3 ผู้ขายมีหน้าที่เก็บข้อมูลประวัติค่าไฟฟ้าของผู้ซื้อย้อนหลังเป็นระยะเวลาไม่น้อยกว่า 2 (สอง) ปี และผู้ซื้อมีสิทธิขอตรวจสอบการคิดค่าไฟฟ้าและขอข้อมูลประวัติการใช้ไฟฟ้าของตนเองตามแบบที่ผู้ขายกำหนด โดยให้ถือว่าข้อมูลดังกล่าวเป็นข้อมูลส่วนบุคคลของผู้ซื้อ</td>
					</tr></table>
					<table class="u"><tr>
						<td><b>4. การคิดค่าไฟฟ้าประจำเดือน</b></td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>4.1 ผู้ขายจะคิดค่าไฟฟ้าโดยกำหนดเป็นรอบระยะเวลาไม่ต่ำกว่ารายเดือนต่อรายมิเตอร์หรือเครื่อง วัดหน่วยไฟฟ้าโดยคำนวณค่าไฟฟ้าจากปริมาณการใช้ไฟฟ้าที่อ่านได้จากมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้า เว้นแต่คู่สัญญาตกลงไว้เป็นอย่างอื่น</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>4.2 กรณีมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าแสดงค่าคลาดเคลื่อนหรือไม่สามารถอ่านหน่วยได้ ผู้ซื้อต้องยินยอมชำระค่าไฟฟ้าไปก่อน ตามค่าไฟฟ้าเฉลี่ยของ 3 (สาม) เดือนหลังสุดที่ถือว่าปกติติดต่อกัน หรือค่าไฟฟ้าที่คำนวณบนพื้นฐานวิศวกรรมไฟฟ้า โดยอาศัยหลักฐานข้อมูลซึ่งตรวจสอบได้ในช่วงเวลานั้น หากภายหลัง ผลการตรวจสอบมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้า มีผลแตกต่างจากที่เรียกเก็บไปแล้ว ผู้ขายจะเรียกเก็บเพิ่มหรือจ่ายเงินคืนแล้วแต่กรณี</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>4.3 กรณีผู้ขายไม่สามารถเข้าอ่านค่าการใช้ไฟฟ้าได้ เนื่องจาก เหตุภัยพิบัติหรือเหตุสุดวิสัยต่าง ๆ เช่น อุทกภัย จลาจล เป็นต้น เมื่อเข้าสู่ภาวะปกติแล้ว ผู้ขายจะนำหน่วยมาเฉลี่ยและคิดค่าไฟฟ้าตามจำนวนเดือนที่ไม่สามารถเข้าอ่านค่าการใช้ไฟฟ้าได้</td>
					</tr></table>
				</td>
			</tr>
			<tr>
				<td colspan="14" class="left top" style="padding:10px;">&nbsp;</td>
			</tr>
			</tbody>
			<tfoot>
			<tr style="height:58px;">
				<td colspan="1">&nbsp;</td>
				<td colspan="6">
					<table class="u"><tr>
						<td style="width:70px;">(ลายมือชื่อ)</td>
						<td class="underline center">&nbsp;<img style="position:absolute;height: 120px;margin: -80px 0 0 -60px;" src="assets/media/users/signed.png" /></td>
						<td class="right" style="width:40px;">ผู้ขาย</td>
					</tr></table>
				</td>
				<td colspan="1">&nbsp;</td>
				<td colspan="6">
					<table class="u"><tr>
						<td style="width:70px;">(ลายมือชื่อ)</td>
						<td class="underline"><span class="u"></span></td>
						<td class="right" style="width:35px;">ผู้ซื้อ</td>
					</tr></table>
				</td>
			</tr>
			</tfoot>
		</table>
		</div>
		
		
		<div class="page">
		<table style="width:210mm;height:297mm;font-size:12px;table-layout: fixed;" border="0">
			<thead>
			<tr >
				<td colspan="14">&nbsp;</td>
				</td>
			</tr>
			<tr style="height:8px;padding-top:10px;">
				<td colspan="2" class="left top" style="padding:10px;">คำร้องเลขที่</td>
				<td colspan="4" class="left top" style="border: 1px solid #000!important;">&nbsp;</td>
				<td colspan="8" class="left top">
				</td>
			</tr>
			</thead>
			<tbody>
			<tr style="height:28px;">
				<td colspan="14" class="left top">&nbsp;</td>
			</tr>
			<tr style="height:8px;">
				<td colspan="14" class="left top" style="padding:10px;">
					<table class="u"><tr>
						<td><b>5. การเรียกเก็บเงินและการชำระเงิน</b></td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>5.1 ผู้ขายจะจัดส่งใบแจ้งค่าไฟฟ้าไปยังผู้ซื้อตามรอบการใช้ไฟฟ้า โดยส่งไปยังที่อยู่ ณ สถานที่ใช้ไฟฟ้า กรณีการส่งใบแจ้งค่าไฟฟ้าไปยังสถานที่อื่นให้เป็นไปตามหลักเกณฑ์วิธีการที่ผู้ขายกำหนดโดยความเห็นชอบของคณะกรรมการกำกับกิจการพลังงาน โดยผู้ขายจะกำหนดเวลาชำระค่าไฟฟ้าในใบแจ้งค่าไฟฟ้าไม่น้อยกว่า 10 (สิบ) วันนับแต่วันลงใบแจ้งค่าไฟฟ้า</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>5.2 หากผู้ซื้อไม่ชำระค่าไฟฟ้าตามกำหนดเวลาในข้อ 5.1 ผู้ขายจะแจ้งเตือนเป็นหนังสือ ณ สถานที่ ตามข้อ 5.1 หรือวิธีการอื่นที่ได้ตกลงกับผู้ซื้อ โดยผู้ชื้อต้องชำระค่าไฟฟ้าภายในกำหนดระยะเวลาที่ปรากฏตามการแจ้งเตือน ซึ่งไม่น้อยกว่า 5 (ห้า) วัน นับแต่วันที่ครบกำหนดชำระ</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>5.3 กรณีผู้ซื้อไม่ชำระค่าไฟฟ้าตามข้อ 5.2 ผู้ขายมีสิทธิงดจ่ายไฟฟ้า เว้นแต่ผู้ซื้อร้องขอผ่อนผัน การงดจ่ายไฟฟ้าเป็นลายลักษณ์อักษรด้วยเหตุผลและความจำเป็น และให้คำมั่นว่าจะไปชำระค่าไฟฟ้าภายในวันทำการถัดไป</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>กรณีผู้ซื้อไม่ชำระค่าไฟฟ้าตามวรรคแรกและให้คำมั่นว่าจะไปชำระค่าไฟฟ้าภายในวันทำการถัดไป อีกครั้ง ให้ผู้ซื้อสามารถร้องขอผ่อนผันได้อีกหนึ่งครั้ง โดยผู้ขายสามารถเรียกเก็บค่าใช้จ่ายที่เกิดขึ้นจาก การดำเนินการได้</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>กรณีที่ผู้ขายงดจ่ายไฟฟ้าไปแล้ว แต่ผู้ซื้อได้ชำระค่าไฟฟ้าภายในวันที่งดจ่ายไฟฟ้า ผู้ขายจะดำเนินการต่อกลับโดยไม่เรียกเก็บค่าธรรมเนียมหรือค่าดำเนินการต่อกลับไฟฟ้า เว้นแต่ชำระเมื่อเกินเวลารับชำระเงินตามปกติของผู้ขาย</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>5.4 ผู้ขายจะเรียกเก็บค่าธรรมเนียมการต่อกลับไฟฟ้าได้ก็ต่อเมื่อผู้ขายได้ดำเนินการงดจ่ายไฟฟ้า ถึงขนาดที่ผู้ซื้อไม่อาจใช้บริการไฟฟ้าได้</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>5.5 กรณีผู้ซื้อชำระค่าไฟฟ้าที่ค้างชำระแล้ว ผู้ขายจะต่อกลับไฟฟ้าคืนให้แก่ผู้ซื้อภายใน 24 (ยี่สิบสี่) ชั่วโมงหรือเป็นไปตามระยะเวลาที่กำหนดไว้ในมาตรฐานคุณภาพการให้บริการ นับแต่เวลาที่ผู้ซื้อชำระค่าไฟฟ้าที่ค้างชำระ เว้นแต่กรณีที่งดจ่ายไฟฟ้าเป็นระยะเวลาเกินกว่า 6 (หก) เดือน</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>5.6 ผู้ซื้อมีสิทธิติดต่อผู้ขายในการเจรจาขอผ่อนผันการชำระค่าไฟฟ้า ทั้งนี้เป็นไปตามหลักเกณฑ์ ที่ผู้ขายกำหนด</td>
					</tr></table>
					<table class="u"><tr>
						<td><b>6. มิเตอร์หรือเครื่องวัดหน่วยไฟฟ้า อุปกรณ์ระบบจำหน่ายไฟฟ้าหรือระบบจ่ายไฟฟ้า และอุปกรณ์ไฟฟ้าภายใน</b></td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>6.1 ผู้ขายมีหน้าที่ตรวจสอบมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าที่ใช้กับผู้ซื้อให้แสดงค่าเที่ยงตรงตามหลักเกณฑ์วิธีการตรวจสอบมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าในทุกๆรอบระยะเวลาสามปีที่ผู้ขายกำหนด โดยความเห็นชอบของคณะกรรมการกำกับกิจการพลังงาน</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>6.2 ผู้ซื้อจะรับผิดชอบและสอดส่องดูแลมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าและอุปกรณ์ประกอบ ทั้งกรณีที่ติดตั้งในที่สาธารณะ หรือในความครอบครองของผู้ซื้อ มิให้ชำรุดเสียหาย</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>ผู้ซื้อจะไม่ขาย หรือต่อโยงไฟฟ้าให้กับผู้อื่นต่อพ่วงไฟฟ้าไปใช้สถานที่อื่น นอกเหนือจากที่ระบุไว้ ในสัญญา ในกรณีที่ต่อโยง ผู้ซื้อต้องรับผิดชอบค่าเสียหาย รวมทั้งยินยอมให้งดจ่ายไฟฟ้าด้วย</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>6.3 ผู้ซื้อจะต้องดูแลบำรุงรักษาอุปกรณ์ไฟฟ้าภายในและเครื่องใช้ไฟฟ้าให้อยู่ในสภาพที่ปลอดภัยรวมทั้งดูแลมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าที่จ่ายไฟฟ้าให้แก่ผู้ซื้อให้มีสภาพการจ่ายไฟฟ้าได้ตามปกติและต้องปฏิบัติตามหนังสือคู่มือการใช้ไฟฟ้าอย่างมีประสิทธิภาพและปลอดภัยที่ผู้ซื้อได้รับไปแล้วในวันทำสัญญานี้</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>6.4 หากผู้ซื้อสงสัยว่ามิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าวัดค่าคลาดเคลื่อน อาจแจ้งให้ผู้ขายทดสอบได้ ถ้าผลการทดสอบปรากฏว่ามิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าคลาดเคลื่อนเกินกว่าร้อยละ ± 2.5 (สองจุดห้า) ผู้ขายจะไม่คิดค่าทดสอบ แต่หากปรากฏว่ามิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าคลาดเคลื่อนไม่เกินกว่าร้อยละ ± 2.5 (สองจุดห้า) ให้ถือว่ามิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าวัดค่าได้เที่ยงตรงตามมาตรฐาน โดยผู้ซื้อยินยอมชำระค่าทดสอบตามอัตราที่คณะกรรมการกำกับกิจการพลังงานพิจารณาให้ความเห็นชอบ และผู้ขายประกาศใช้อยู่ในขณะนั้น ๆ</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>ในกรณีที่ผู้ซื้อสงสัยว่ามิเตอร์หรือเครื่องวัดหน่วยไฟฟ้ามีการชำรุดเกิดขึ้นเนื่องจากสภาพการใช้งานตามปกติ ผู้ขายจะดำเนินการเปลี่ยนมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าให้ใหม่โดยไม่คิดค่าใช้จ่าย แต่หาก การชำรุดเกิดจากการใช้ไฟฟ้าเกินขนาดการใช้ไฟฟ้าที่กำหนด หรือมีสาเหตุจากผู้ซื้อ ผู้ขายจะดำเนินการเปลี่ยนให้ใหม่ โดยผู้ซื้อเป็นผู้ชำระค่าใช้จ่าย ค่าเสียหาย หรือค่าธรรมเนียม</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>6.5 อุปกรณ์ระบบจำหน่ายไฟฟ้าหรือระบบจ่ายไฟฟ้ารวมทั้งมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าเป็นกรรมสิทธิ์ของผู้ขาย ส่วนอุปกรณ์ไฟฟ้าภายในที่ติดตั้งหลังมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าเป็นกรรมสิทธิ์ของ ผู้ซื้อ ผู้ซื้อสัญญาว่าจะไม่กระทำหรือใช้ให้ผู้อื่นกระทำโดยมิชอบต่ออุปกรณ์ระบบจำหน่ายไฟฟ้าหรือระบบจ่ายไฟฟ้าหรือมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้า หากมีหลักฐานเชื่อได้ว่าผู้ซื้อมีเจตนากระทำหรือใช้ให้ผู้อื่นกระทำ ผู้ซื้อยอมให้ผู้ขายงดจ่ายไฟฟ้า และยอมชำระค่าเสียหาย ค่าไฟฟ้าเพิ่มย้อนหลัง ตลอดจนยินยอมชำระเบี้ยปรับตามอัตราที่ผู้ขายกำหนด</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>6.6 ผู้ซื้อต้องจัดหาอุปกรณ์ตัดวงจรไฟฟ้าและเครื่องป้องกันกระแสไฟฟ้าเกินติดตั้งไว้ระหว่างมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้าของผู้ขายกับวงจรไฟฟ้าภายในของผู้ซื้อ โดยอุปกรณ์ตัดวงจรไฟฟ้าและเครื่องป้องกันกระแสไฟฟ้าเกิน ต้องมีขนาดที่สามารถตัดกระแสไฟฟ้าสอดคล้องกับขนาดของมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้า และต้องมีความทนทานในการตัดกระแสไฟฟ้าลัดวงจร (Interrupting Capacity) เมื่อเกิดไฟฟ้าลัดวงจรในอุปกรณ์ไฟฟ้าภายใน หากผู้ซื้อมิได้ดำเนินการจนเกิดความเสียหายต่อระบบจำหน่ายไฟฟ้าหรือระบบจ่ายไฟฟ้าของผู้ขาย ผู้ซื้อยินยอมชำระค่าเสียหายให้แก่ผู้ขายเนื่องจากเหตุดังกล่าว</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>6.7 ผู้ซื้อต้องไม่สร้างสิ่งปิดกั้นอุปกรณ์ระบบจำหน่ายไฟฟ้าหรือระบบจ่ายไฟฟ้าหรือกระทำการอย่างใด ๆ จนเป็นเหตุให้อาจเกิดอันตราย ไม่สะดวกในการตรวจสอบ และบำรุงรักษาอุปกรณ์ระบบจำหน่ายไฟฟ้าหรือระบบจ่ายไฟฟ้าหรือการจดหน่วยไฟฟ้า หากฝ่าฝืนผู้ขายมีสิทธิรื้อถอนและเรียกเก็บค่าใช้จ่ายรวมทั้งงดจ่ายไฟฟ้า และไม่รับผิดชอบกรณีมีค่าเสียหายเกิดขึ้น เว้นแต่มีข้อตกลงเป็นอย่างอื่น</td>
					</tr></table>
				</td>
			</tr>
			<tr>
				<td colspan="14" class="left top" style="padding:10px;">&nbsp;</td>
			</tr>
			</tbody>
			<tfoot>
			<tr style="height:58px;">
				<td colspan="1">&nbsp;</td>
				<td colspan="6">
					<table class="u"><tr>
						<td style="width:70px;">(ลายมือชื่อ)</td>
						<td class="underline center">&nbsp;<img style="position:absolute;height: 120px;margin: -80px 0 0 -60px;" src="assets/media/users/signed.png" /></td>
						<td class="right" style="width:40px;">ผู้ขาย</td>
					</tr></table>
				</td>
				<td colspan="1">&nbsp;</td>
				<td colspan="6">
					<table class="u"><tr>
						<td style="width:70px;">(ลายมือชื่อ)</td>
						<td class="underline"><span class="u"></span></td>
						<td class="right" style="width:35px;">ผู้ซื้อ</td>
					</tr></table>
				</td>
			</tr>
			</tfoot>
		</table>
		</div>
		
		
		<div class="page">
		<table style="width:210mm;height:297mm;font-size:12px;table-layout: fixed;" border="0">
			<thead>
			<tr >
				<td colspan="14">&nbsp;</td>
				</td>
			</tr>
			<tr style="height:8px;padding-top:10px;">
				<td colspan="2" class="left top" style="padding:10px;">คำร้องเลขที่</td>
				<td colspan="4" class="left top" style="border: 1px solid #000!important;">&nbsp;</td>
				<td colspan="8" class="left top">
				</td>
			</tr>
			</thead>
			<tbody>
			<tr style="height:28px;">
				<td colspan="14" class="left top">&nbsp;</td>
			</tr>
			<tr style="height:8px;">
				<td colspan="14" class="left top" style="padding:10px;">
					<table class="u"><tr>
						<td><b>7. การกระทำโดยมิชอบเกี่ยวกับการใช้ไฟฟ้าหรือการละเมิดการใช้ไฟฟ้า</b></td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>“การกระทำโดยมิชอบเกี่ยวกับการใช้ไฟฟ้าหรือการละเมิดการใช้ไฟฟ้า” หมายความว่า การกระทำใด ๆ โดยมิชอบด้วยกฎหมายต่ออุปกรณ์ระบบจำหน่ายไฟฟ้าหรือระบบจ่ายไฟฟ้า มิเตอร์หรือเครื่องวัดหน่วยไฟฟ้า อุปกรณ์ประกอบมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้า เครื่องหมายหรือตราของผู้ขาย หรือการต่อไฟฟ้าตรงโดยไม่ผ่านมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้า หรือการละเมิดการใช้ไฟฟ้ากรณีอื่น ๆ เป็นผลให้ผู้ขายได้รับความเสียหาย</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>7.1 ผู้ซื้อจะไม่กระทำการใด ๆ หรือยอมให้ผู้อื่นกระทำการใด หรือได้รับประโยชน์จากการกระทำดังกล่าว อันเป็นการกระทำโดยมิชอบเกี่ยวกับการใช้ไฟฟ้าหรือการละเมิดการใช้ไฟฟ้า</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>กรณีผู้ขายตรวจพบว่ามีการกระทำโดยมิชอบเกี่ยวกับการใช้ไฟฟ้าหรือการละเมิดการใช้ไฟฟ้า ผู้ขายจะดำเนินการตามกฎหมายกับผู้กระทำโดยมิชอบเกี่ยวกับการใช้ไฟฟ้าหรือการละเมิดการใช้ไฟฟ้า ผู้ครอบครองสถานที่ใช้ไฟฟ้า ผู้ที่อยู่อาศัยหรือผู้ที่ได้รับประโยชน์จากการกระทำดังกล่าว โดยผู้ซื้อยินยอมชำระค่าเบี้ยปรับ และค่าไฟฟ้าที่เสียหายตามการปรับปรุงย้อนหลัง ตลอดจนค่าเสียหายอื่นใดอันเนื่องมาจากการกระทำโดยมิชอบเกี่ยวกับการใช้ไฟฟ้าหรือการละเมิดการใช้ไฟฟ้าตามประกาศของผู้ขาย รวมทั้งยินยอมให้ผู้ขายงดจ่ายไฟฟ้า</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>7.2 ค่าไฟฟ้าที่เสียหายตามการปรับปรุงย้อนหลังตลอดจนค่าเสียหายอื่นใด หากผู้ซื้อขอผ่อนชำระ ผู้ขายจะคิดดอกเบี้ยผ่อนชำระตามหลักเกณฑ์ของผู้ขาย</td>
					</tr></table>
					<table class="u"><tr>
						<td><b>8. การคิดค่าไฟฟ้าต่ำหรือเกินกว่าความเป็นจริง</b></td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>8.1 การคิดค่าไฟฟ้าต่ำกว่าความเป็นจริง</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>กรณีผู้ขายมีการคิดค่าไฟฟ้าต่ำกว่าความเป็นจริง เนื่องจากความคลาดเคลื่อนของมิเตอร์หรือเครื่องวัดหน่วยไฟฟ้า และหรืออุปกรณ์ประกอบมิเตอร์หรืออุปกรณ์ประกอบเครื่องวัดหน่วยไฟฟ้า หรือเกิดจากสาเหตุอื่น ๆ ซึ่งมิใช่ความผิดของผู้ซื้อเป็นผลให้ต้องปรับปรุงยอดการเรียกเก็บค่าไฟฟ้าเพิ่มขึ้น ผู้ขายมีสิทธิที่จะเรียกเก็บค่าส่วนต่างได้ โดยผู้ขายจะแจ้งให้ผู้ซื้อทราบโดยเร็ว ทั้งนี้ ผู้ขายจะเรียกเก็บค่าส่วนต่างการคิดค่าไฟฟ้าที่ ต่ำกว่าความเป็นจริงย้อนหลังตั้งแต่ระยะเวลาผิดพลาดหรือคลาดเคลื่อนนั้น แต่ไม่เกิน 3 (สาม) ปี ผู้ซื้อมีสิทธิขอผ่อนชำระค่าไฟฟ้าได้ตามหลักเกณฑ์ที่ผู้ขายกำหนดโดยความเห็นชอบของคณะกรรมการกำกับกิจการพลังงาน และผู้ขายจะไม่คิดดอกเบี้ยในการผ่อนชำระ</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>8.2 การคิดค่าไฟฟ้าเกินกว่าความเป็นจริง</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>กรณีมีการคิดค่าไฟฟ้าเกินกว่าความเป็นจริง ผู้ขายจะแจ้งให้ผู้ซื้อทราบภายใน 15 (สิบห้า) วัน นับแต่วันที่ตรวจพบความผิดพลาด หากผู้ซื้อได้ชำระส่วนเกินไปแล้ว ผู้ขายจะคืนเงินส่วนต่างให้ผู้ซื้อเป็นตัวเงิน ภายใน 30 (สามสิบ) วัน นับแต่วันที่แจ้งให้ ผู้ซื้อทราบ</td>
					</tr></table>
					<table class="u"><tr>
						<td><b>9. หลักประกันการใช้ไฟฟ้า</b></td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:125px;"><span style="padding-left:40px;">&nbsp;</span>9.1 ผู้ซื้อได้นำ</td>
						<td class="underline"><span class="u"></span></td>
						<td class="right" style="width:160px;">วางค้ำประกันการใช้ไฟฟ้าตาม</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:100px;">สัญญานี้ จำนวน</td>
						<td class="underline"><span class="u"></span></td>
						<td class="center" style="width:45px;">บาท (</td>
						<td class="underline"><span class="u"></span></td>
						<td class="right" style="width:60px;">) เพื่อเป็น</td>
					</tr></table>
					<table class="u"><tr>
						<td>หลักประกันการใช้ไฟฟ้า เช่น ค่าไฟฟ้า ค่าเบี้ยปรับ ดอกเบี้ย หนี้อื่นที่เกี่ยวข้องกับการใช้ไฟฟ้า และหรือหนี้สินที่เกิดจากการไม่ปฏิบัติตามสัญญาซื้อขายไฟฟ้า</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>9.2 หลักประกันที่ผู้ซื้อนำมามอบให้เป็นการเรียกเก็บในครั้งแรกที่เริ่มการใช้ไฟฟ้าตามอัตราที่ผู้ขายกำหนด หากปรากฏว่าหลักประกันดังกล่าวลดลงด้วยเหตุใดๆ หรือมีจำนวนหลักประกันไม่เป็นไปตามอัตราที่กำหนดก็ตาม ผู้ซื้อต้องหาหลักประกันใหม่หรือหลักประกันเพิ่มเติมให้มีจำนวนครบถ้วนมามอบให้แก่ผู้ขายภายใน ๑๕ (สิบห้า) วัน นับแต่วันที่ได้รับแจ้งเป็นหนังสือจากผู้ขาย หากไม่ปฏิบัติตามผู้ซื้อยินยอมให้ผู้ขาย งดจ่ายไฟฟ้าได้</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>9.3 กรณีที่ผู้ซื้อวางหลักประกันการใช้ไฟฟ้าด้วยเงินสด ผู้ขายจะคืนดอกผลที่เกิดขึ้นจากการวางเงินประกันการใช้ไฟฟ้าให้ผู้ซื้อตามเงื่อนไขที่ผู้ขายกำหนดโดยความเห็นชอบของคณะกรรมการกำกับกิจการพลังงาน</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>เมื่อสัญญาสิ้นสุดลงและผู้ซื้อไม่มีหนี้สินค้างชำระ ผู้ขายจะจ่ายคืนหลักประกันการใช้ไฟฟ้ารวมทั้ง ดอกผลที่เกิดขึ้นจากการวางเงินประกันการใช้ไฟฟ้า (ถ้ามี) ให้แก่ผู้ซื้อภายใน 30 (สามสิบ) วัน นับแต่วันที่สัญญาสิ้นสุดลง</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>9.4 ผู้ขายมีสิทธินำหลักประกันการใช้ไฟฟ้ารวมทั้งดอกผลที่เกิดขึ้นมาชำระหนี้ ในกรณีดังต่อไปนี้</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:80px;">&nbsp;</span>9.4.1 ผู้ซื้อไม่ชำระค่าไฟฟ้า หรือหนี้อื่นที่เกี่ยวข้องกับการใช้ไฟฟ้า และหรือหนี้สินที่เกิดจากการไม่ปฏิบัติตามสัญญาซื้อขายไฟฟ้า และถูกงดจ่ายไฟฟ้า</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:80px;">&nbsp;</span>9.4.2 เป็นค่าไฟฟ้างวดสุดท้ายเมื่อสัญญาสิ้นสุดลง</td>
					</tr></table>
					<table class="u"><tr>
						<td><b>10. ข้อยกเว้นการงดจ่ายไฟฟ้า</b></td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>ผู้ขายไม่สามารถงดจ่ายไฟฟ้าได้ในกรณี ดังต่อไปนี้</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>10.1 วันเสาร์และวันอาทิตย์</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>10.2 ผู้ซื้อหรือผู้ซื้อที่มีบุคคลอยู่ในความดูแลหรือมีผู้ป่วยที่มีความจำเป็นต้องใช้ไฟฟ้าในการเดินเครื่องมือทางการแพทย์เพื่อการรักษาพยาบาล หากไม่เช่นนั้นจะเป็นอันตรายต่อชีวิต ร่างกาย หรือสุขภาพ และลงทะเบียนรายชื่อกับผู้ขายตามหลักเกณฑ์ที่กำหนดโดยความเห็นชอบของคณะกรรมการกำกับกิจการพลังงาน</td>
					</tr></table>
				</td>
			</tr>
			<tr>
				<td colspan="14" class="left top" style="padding:10px;">&nbsp;</td>
			</tr>
			</tbody>
			<tfoot>
			<tr style="height:58px;">
				<td colspan="1">&nbsp;</td>
				<td colspan="6">
					<table class="u"><tr>
						<td style="width:70px;">(ลายมือชื่อ)</td>
						<td class="underline center">&nbsp;<img style="position:absolute;height: 120px;margin: -80px 0 0 -60px;" src="assets/media/users/signed.png" /></td>
						<td class="right" style="width:40px;">ผู้ขาย</td>
					</tr></table>
				</td>
				<td colspan="1">&nbsp;</td>
				<td colspan="6">
					<table class="u"><tr>
						<td style="width:70px;">(ลายมือชื่อ)</td>
						<td class="underline"><span class="u"></span></td>
						<td class="right" style="width:35px;">ผู้ซื้อ</td>
					</tr></table>
				</td>
			</tr>
			</tfoot>
		</table>
		</div>
		
		
		
		<div class="page">
		<table style="width:210mm;height:297mm;font-size:12px;table-layout: fixed;" border="0">
			<thead>
			<tr >
				<td colspan="14">&nbsp;</td>
				</td>
			</tr>
			<tr style="height:8px;padding-top:10px;">
				<td colspan="2" class="left top" style="padding:10px;">คำร้องเลขที่</td>
				<td colspan="4" class="left top" style="border: 1px solid #000!important;">&nbsp;</td>
				<td colspan="8" class="left top">
				</td>
			</tr>
			</thead>
			<tbody>
			<tr style="height:28px;">
				<td colspan="14" class="left top">&nbsp;</td>
			</tr>
			<tr style="height:8px;">
				<td colspan="14" class="left top" style="padding:10px;">
					<table class="u"><tr>
						<td><b>11. การร้องเรียน และการแก้ไขปัญหาข้อร้องเรียน</b></td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>ผู้ขายจะจัดทำหลักเกณฑ์และวิธีพิจารณาเรื่องร้องเรียนที่เกิดจากการปฏิบัติตามสัญญานี้ ซึ่งมีข้อกำหนดเกี่ยวกับขั้นตอน ระยะเวลาดำเนินการ รวมถึงการบรรเทาความเดือดร้อนเสียหายหรือผลกระทบเฉพาะหน้าให้กับผู้ซื้อ โดยหลักเกณฑ์ดังกล่าวจะสอดคล้องกับขั้นตอนและระยะเวลาตามที่กฎหมายว่าด้วยการประกอบกิจการพลังงานกำหนด</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>ทั้งนี้ ผู้ขายจะประกาศหลักเกณฑ์ให้ผู้ซื้อทราบ ผ่านสื่อที่ผู้ซื้อเข้าถึงโดยเร็ว รวมทั้งแสดง ณ ที่ทำการของผู้ขายเพื่อให้ผู้ซื้อสามารถตรวจสอบได้</td>
					</tr></table>
					<table class="u"><tr>
						<td><b>12. การเปลี่ยนแปลงข้อสัญญา</b></td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>กรณีผู้ขายจำเป็นต้องแก้ไขเพิ่มเติมข้อกำหนดในสัญญานี้ให้แตกต่างไปจากเดิม หากการดำเนินการนั้นเป็นไปเพื่อประโยชน์ของคู่สัญญาและไม่ทำให้เสียประโยชน์แก่ผู้ซื้อ ให้สามารถดำเนินการได้โดยได้รับความเห็นชอบจากคณะกรรมการกำกับกิจการพลังงาน</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>ทั้งนี้ ผู้ขายจะประกาศให้ผู้ซื้อทราบถึงการแก้ไขเพิ่มเติมดังกล่าวผ่านทางสื่อที่ผู้ซื้อเข้าถึงโดยเร็ว รวมทั้งแสดง ณ ที่ทำการของผู้ขายเพื่อให้ตรวจสอบได้ และให้ถือว่าการแก้ไขเพิ่มเติมเปลี่ยนแปลงดังกล่าวเป็นส่วนหนึ่งของหนังสือสัญญานี้</td>
					</tr></table>
					<table class="u"><tr>
						<td><b>13. การสิ้นสุดของสัญญา</b></td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>13.1 การบอกเลิกสัญญา ให้คู่สัญญาฝ่ายที่ขอบอกเลิกสัญญา ทำเป็นหนังสือแจ้งบอกเลิกสัญญาไปยังคู่สัญญาอีกฝ่ายหนึ่งทราบล่วงหน้าไม่น้อยกว่า 15 (สิบห้า) วัน ก่อนวันที่ประสงค์จะเลิกสัญญา</td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>13.2 ผู้ซื้อถูกงดจ่ายไฟฟ้าเนื่องจากไม่ปฏิบัติตามสัญญานี้และไม่กลับมาขอใช้ไฟฟ้าใหม่ภายหลังการแก้ไขเหตุที่ถูกงดจ่ายไฟฟ้า รวมทั้งไม่ชำระค่าบริการที่เกี่ยวข้อง หลังจาก 90 (เก้าสิบ) วัน นับจากวันที่ถูกงดจ่ายไฟฟ้า้<br /></td>
					</tr></table>
					<table class="u"><tr>
						<td><span style="padding-left:40px;">&nbsp;</span>หนังสือสัญญาฉบับนี้ได้จัดทำขึ้นเป็นสองฉบับ มีข้อความตรงกันทุกประการ คู่สัญญาได้อ่านสัญญานี้โดยตลอดเป็นที่เข้าใจดีแล้ว จึงได้ลงลายมือชื่อ และประทับตรา (ถ้ามี) ไว้เป็นสำคัญต่อหน้าพยาน แล้วมอบต้นฉบับให้แก่ผู้ขาย และคู่ฉบับให้ ผู้ซื้อเก็บไว้เป็นหลักฐานต่อกัน</td>
					</tr></table>
				</td>
			</tr>
			<tr>
				<td colspan="14" class="left top" style="padding:10px;">&nbsp;</td>
			</tr>
			</tbody>
			<tfoot>
			<tr style="height:50px;">
				<td colspan="1">&nbsp;</td>
				<td class="center top" colspan="6">
					<table class="u"><tr>
						<td>การไฟฟ้าส่วนภูมิภาค</td>
					</tr></table>
				</td>
				<td colspan="7">&nbsp;</td>
			</tr>
			<tr style="height:58px;">
				<td colspan="1">&nbsp;</td>
				<td class="center top" colspan="6">
					<table class="u"><tr>
						<td style="width:70px;">(ลายมือชื่อ)</td>
						<td class="underline">&nbsp;<img style="position:absolute;height: 120px;margin: -80px 0 0 -60px;" src="assets/media/users/signed.png" /></td>
						<td class="right" style="width:40px;">ผู้ขาย</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:70px;">&nbsp;</td>
						<td class="center" style="position:relative;"><div class="u">นายศุภชัย   พันติ</div></td>
						<td class="right" style="width:40px;">&nbsp;</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:70px;">ตำแหน่ง</td>
						<td class="underline">หัวหน้าแผนกบริการลูกค้า ผู้รับมอบอำนาจช่วง</td>
					</tr></table>
					
					<table style="height:30px;"><tr>
						<td>&nbsp;</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:70px;">(ลายมือชื่อ)</td>
						<td class="underline"><span class="u"></span></td>
						<td class="right" style="width:35px;">พยาน</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:70px;">&nbsp;</td>
						<td class="center" style="position:relative;"><div class="u"><?php echo $data['meter_staff_name']; ?></div></td>
						<td class="right" style="width:35px;">&nbsp;</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:70px;">ตำแหน่ง</td>
						<td class="underline"><span class="u"><?php echo $data['meter_staff_position']; ?></span></td>
					</tr></table>
					<table style="height:30px;"><tr>
						<td>&nbsp;</td>
					</tr></table>
				</td>
				<td colspan="1">&nbsp;</td>
				<td class="center top" colspan="6">
					<table class="u"><tr>
						<td style="width:70px;">(ลายมือชื่อ)</td>
						<td class="underline center"><span class="u"></span></td>
						<td class="right" style="width:35px;">ผู้ซื้อ</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:70px;">&nbsp;</td>
						<td class="center" style="position:relative;"><div class="u"><?php echo $data['customer_name2']; ?></div></td>
						<td class="right" style="width:35px;">&nbsp;</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:70px;">ตำแหน่ง</td>
						<td class="underline center"><span class="u"><?php echo $data['customer_status']; ?></span></td>
					</tr></table>
					<table style="height:30px;"><tr>
						<td>&nbsp;</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:70px;">(ลายมือชื่อ)</td>
						<td class="underline"><span class="u"></span></td>
						<td class="right" style="width:35px;">พยาน</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:70px;">&nbsp;</td>
						<td class="center" style="position:relative;"><div class="u">&nbsp;</div></td>
						<td class="right" style="width:35px;">&nbsp;</td>
					</tr></table>
					<table class="u"><tr>
						<td style="width:70px;">ตำแหน่ง</td>
						<td class="underline"><span class="u"></span></td>
					</tr></table>
					<table style="height:30px;"><tr>
						<td>&nbsp;</td>
					</tr></table>
				</td>
			</tr>
			</tfoot>
		</table>
		</div>
		
 </body>

</html>