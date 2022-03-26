<?php
 @require_once('../config.php');
	@require_once('../class/meter.php');
	
	$meter = new Meter();
	
	$staff = $meter->getMeterStaff();
	$meter_size = $meter->getMeterSize();
	
	$record_id = (isset($_GET['record_id']))? $_GET['record_id'] : 0;
	$token = (isset($_GET['token']))? $_GET['token'] : 0;
	$data = array();
	if ($record_id && $token) {
		$result = $meter->getMeterDetail($record_id, $token);
		if ($result['total']) $data = $result['items'][0];
	} else die('Need record_id and token to process!');
?>
<div class="modal-dialog modal-xl" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">รายละเอียดข้อมูลในส่วนของเจ้าหน้าที่</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			</button>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<?php
					foreach ($_SESSION['error'] as $error) {
						echo '<div class="alert alert-danger"><strong>Error!</strong> ' . $error . ' </div>';
					}
					$_SESSION['error'] = array();
				?>
			</div>
		</div>
		
		<div class="modal-body">
			<form class="kt-form kt-form--label-right" action method="POST" id="modal_form_document">
				<input type="hidden" class="form-control" name="record_id" value="<?php echo $record_id; ?>" />
				<input type="hidden" class="form-control" name="token" value="<?php echo $token; ?>" />
				<div class="form-group form-group-last">
					<div class="alert alert-secondary" role="alert">
						<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
						<div class="alert-text">
							ในช่วงไวรัสแพร่ระบาด ขอให้ผู้ใช้ไฟฟ้าทุกท่านกรอกข้อมูลต่างๆ ผ่านระบบออนไลน์เป็นหลัก เพื่อลดการเดินทาง และสัมผัสกับผู้อื่น อีกทั้งยังเพิ่มความรวดเร็วแก่ในการดำเนินการแก่เจ้าหน้าที่
						</div>
					</div>
				</div>
				
				
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">เจ้าหน้าที่ผู้รับคำร้อง:</label>
					<div class="col-9">
						<select class="form-control" name="meter_staff_id">
							<option value="">----- กรุณาเลือก -----</option>
							<?php if ($staff['total']) { ?>
								<?php foreach ($staff['items'] as $item) { ?>
									<option value="<?php echo $item['meter_staff_id']; ?>" <?php echo (isset($data['meter_staff_id']) && $data['meter_staff_id'] == $item['meter_staff_id'])? 'selected' : ''; ?>><?php echo $item['meter_staff_name']; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">ชื่อผู้ลงระบบ SAP:</label>
					<div class="col-9">
						<select class="form-control" name="sap_staff_id">
							<option value="">----- กรุณาเลือก -----</option>
							<?php if ($staff['total']) { ?>
								<?php foreach ($staff['items'] as $item) { ?>
									<option value="<?php echo $item['meter_staff_id']; ?>" <?php echo (isset($data['sap_staff_id']) && $data['sap_staff_id'] == $item['meter_staff_id'])? 'selected' : ''; ?>><?php echo $item['meter_staff_name']; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">ผู้ใช้ไฟฟ้าประเภท:</label>
					<div class="col-9">
						<select class="form-control" name="customer_type">
							<option value="ที่อยู่อาศัย" <?php echo (isset($data['customer_type']) && $data['customer_type'] == 'ที่อยู่อาศัย')? 'selected' : ''; ?>>ที่อยู่อาศัย</option>
							<option value="กิจการขนาดเล็ก" <?php echo (isset($data['customer_type']) && $data['customer_type'] == 'กิจการขนาดเล็ก')? 'selected' : ''; ?>>กิจการขนาดเล็ก</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">หมายเลขผู้ใช้ไฟรายใหม่:</label>
					<div class="col-9">
						<input type="text" class="form-control" name="new_pea_no" value="<?php echo (isset($data['new_pea_no']))? $data['new_pea_no'] : ''; ?>" />
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">ขนาด (แอมป์):</label>
					<div class="col-9">
						<input type="text" class="form-control" name="meter_amp" value="<?php echo (isset($data['meter_amp']))? $data['meter_amp'] : ''; ?>" />
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">ขนาด (เฟส):</label>
					<div class="col-9">
						<input type="text" class="form-control" name="meter_phase" value="<?php echo (isset($data['meter_phase']))? $data['meter_phase'] : ''; ?>" />
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">ขนาด (เควีเอ):</label>
					<div class="col-9">
						<input type="text" class="form-control" name="meter_kva" value="<?php echo (isset($data['meter_kva']))? $data['meter_kva'] : ''; ?>" />
					</div>
				</div>
				<hr />
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">วันที่ยื่นคำร้อง:</label>
					<div class="col-9">
						<input type="date" class="form-control" name="document_date" value="<?php echo (isset($data['document_date']))? $data['document_date'] : ''; ?>" />
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">วันที่ลงระบบ SAP:</label>
					<div class="col-9">
						<input type="date" class="form-control" name="sap_date" value="<?php echo (isset($data['sap_date']))? $data['sap_date'] : ''; ?>" />
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">กำหนดรอบบิล:</label>
					<div class="col-9">
						<input type="text" class="form-control" name="due_date" value="<?php echo (isset($data['due_date']))? $data['due_date'] : ''; ?>" />
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">หนี้ค้างชำระ:</label>
					<div class="col-9">
						<input type="number" class="form-control" name="overdue_debt" value="<?php echo (isset($data['overdue_debt']))? $data['overdue_debt'] : ''; ?>" min="0.00" step="0.01" />
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">วันที่ตรวจหนี้ค้าง:</label>
					<div class="col-9">
						<input type="date" class="form-control" name="overdue_date" value="<?php echo (isset($data['overdue_date']))? $data['overdue_date'] : ''; ?>" />
					</div>
				</div>
			</form>	
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
			<button type="button" class="btn btn-primary" id="button_save_document">บันทึกข้อมูล</button>
		</div>
	</div>
</div>
<script>
	$(function() {
		
		$("#button_save_document").on("click", function(e){
			$("#modal_form_document").submit();
		});
		
	});
</script>