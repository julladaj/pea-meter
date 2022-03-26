<?php
	@require_once('config.php');
	@require_once('class/meter.php');

	$c_meter = new Meter();
	$rows = $c_meter->getJSONDocument();

	$field_list = $c_meter->getFullColumns('document_transaction');
	
	$strExcelFileName = "pea_documents.xls";
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
						<th>เจ้าหน้าที่ผู้รับคำร้อง</th>
						<th>วันที่รับคำร้อง</th>
						<th>ชื่อผู้ลงระบบ SAP</th>
						<th>วันที่ลงระบบ SAP</th>
						<th>กำหนดรอบบิล</th>
						<th>หนี้ค้างชำระ</th>
						<th>วันที่ตรวจหนี้ค้าง</th>
<?php
	foreach ($field_list as $field) {
		if (isset($field['Comment']) && $field['Comment']) {
?>
						<th><?php echo $field['Comment']; ?></th>
<?php } ?>
<?php } ?>
					</tr>
<?php
		foreach ($rows['items'] as $data) {
?>
					<tr>
						<td><?php echo $data['meter_staff_name']; ?></td>
						<td><?php echo $data['document_date']; ?></td>
						<td><?php echo $data['sap_staff_name']; ?></td>
						<td><?php echo $data['sap_date']; ?></td>
						<td><?php echo $data['due_date']; ?></td>
						<td><?php echo $data['overdue_debt']; ?></td>
						<td><?php echo $data['overdue_date']; ?></td>
<?php
	foreach ($field_list as $field) {
		if (isset($field['Comment']) && $field['Comment']) {
?>
						<th><?php echo $data[$field['Field']]; ?></th>
<?php } ?>
<?php } ?>
					</tr>
<?php
		}						
?>
				</table>
			</div>
			<script>
				window.onbeforeunload = function(){return false;};
				setTimeout(function(){window.close();}, 10000);
			</script>
		</body>
	</html>			