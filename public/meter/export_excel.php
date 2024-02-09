<?php
	@require_once('config.php');
	@require_once('class/meter.php');

	$c_meter = new _Meter();
	$filter['filter'] = (isset($_POST))? json_encode($_POST) : '';
	$rows = $c_meter->getJSONMeter($filter);

	$field_list = $c_meter->getFullColumns('meter');
	
	$strExcelFileName = "pea_meters.xls";
	header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
	header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
	header("Pragma:no-cache");
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		</head>
		<body>
			<strong>ข้อมูล วันที่ <?php echo date("d-M Y");?>  จำนวนทั้งหมด <?php echo number_format($rows['total']);?> ใบ</strong><br>
			<br>
			<div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
				<table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
					<tr>
						<th>เลขคำร้อง</th>
						<th>หมายเลขผู้ใช้ไฟ</th>
						<th>วันที่ยื่นคำร้อง</th>
						<th>ชื่อ นามสกุล</th>
						<th>เบอร์โทรศัพท์</th>
						<th>ประเภทคำร้อง</th>
						<th>ขนาดมิเตอร์</th>
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
						<th>ระดับความพึงพอใจ</th>
						<th>วันที่ประเมิน</th>
						<th>ข้อเสนอแนะเพิ่มเติม</th>
					</tr>
<?php
		foreach ($rows['items'] as $data) {
?>
					<tr>
						<td><?php echo $data['auto_id']; ?></td>
						<td><?php echo $data['number1']; ?></td>
						<td><?php echo $data['date_add']; ?></td>
						<td><?php echo $data['fname']; ?></td>
						<td><?php echo $data['telephone']; ?></td>
						<td><?php echo $data['meter_category_detail']; ?></td>
						<td><?php echo $data['meter_size_detail']; ?></td>
						<td><?php echo $data['recipient_name']; ?></td>
						<td><?php echo $data['date_appoint']; ?></td>
						<td><?php echo $data['officer_name']; ?></td>
						<td><?php echo $data['meter_qc_detail']; ?></td>
						<td><?php echo $data['cause']; ?></td>
						<td><?php echo $data['date_payment']; ?></td>
						<td><?php echo $data['cause1']; ?></td>
						<td><?php echo $data['date_install']; ?></td>
						<td><?php echo $data['date_deathline']; ?></td>
						<td><?php echo $data['number2']; ?></td>
						<td><?php echo $data['date_finish']; ?></td>
						<td><?php echo $data['evaluation_score']; ?></td>
						<td><?php echo empty($data['evaluation_score']) ? '' : $data['evaluation_time']; ?></td>
						<td><?php echo empty($data['evaluation_score']) ? '' : $data['evaluation_comment']; ?></td>
					</tr>
<?php
		}						
?>
				</table>
			</div>
<!--			<script>-->
<!--				window.onbeforeunload = function(){return false;};-->
<!--				setTimeout(function(){window.close();}, 10000);-->
<!--			</script>-->
		</body>
	</html>			