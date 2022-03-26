<?php
 @require_once('../config.php');
	@require_once('../class/meter.php');
	
?>
<div class="modal-dialog modal-xl" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">รายละเอียดข้อมูล ติดตั้งมิเตอร์/เพิ่ม/ย้าย/เปลี่ยนประเภท</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			</button>
		</div>
		<div class="modal-body">
			<form class="kt-form kt-form--label-right" action method="POST">
			
				<div class="form-group form-group-last">
					<div class="alert alert-secondary" role="alert">
						<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
						<div class="alert-text">
							ในช่วงไวรัสแพร่ระบาด ขอให้ผู้ใช้ไฟฟ้าทุกท่านกรอกข้อมูลต่างๆ ผ่านระบบออนไลน์เป็นหลัก เพื่อลดการเดินทาง และสัมผัสกับผู้อื่น อีกทั้งยังเพิ่มความรวดเร็วแก่ในการดำเนินการแก่เจ้าหน้าที่
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label for="example-text-input" class="col-3 col-form-label">ชื่อ-นามสกุล:</label>
					<div class="col-9">
						<input type="text" class="form-control" placeholder="ระบุ ชื่อ และ นามสกุล">
						<span class="form-text text-muted">ระบุชื่อและนามสกุลให้ครบถ้วน เพื่อความรวดเร็วแก่เจ้าหน้าที่ และผลประโยชน์ของท่านเอง</span>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">หมายเลขผู้ใช้ไฟ:</label>
					<div class="col-9">
						<input type="text" class="form-control" placeholder="ระบุ หมายเลขผู้ใช้ไฟ">
						<span class="form-text text-muted">ตัวอย่างเช่น 200232... หรือ ACH26... เป็นต้น</span>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">เบอร์โทร:</label>
					<div class="col-9">
						<input type="text" class="form-control" placeholder="ระบุ หมายเลขเบอร์โทรศัพท์ 10 หลัก">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">ประเภทคำร้อง:</label>
					<div class="col-9">
						<select class="form-control">
							<option value="">----- กรุณาเลือก -----</option>
							<option value="ขอใหม่">ขอใหม่</option>
							<option value="ไฟ ชค.">ไฟ ชค.</option>
							<option value="เพิ่มขนาด.">เพิ่มขนาด</option>
							<option value="ลดขนาด">ลดขนาด</option>
							<option value="ย้าย">ย้าย</option>
							<option value="เปลี่ยนประเภท">เปลี่ยนประเภท</option>
							<option value="เลิกใช้+ขอใหม่">เลิกใช้+ขอใหม่</option>
							<option value="อื่นๆ">อื่นๆ</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">ขนาด:</label>
					<div class="col-9">
						<select class="form-control">
							<option value="">----- กรุณาเลือก -----</option>
							<option value="5  A 1 p"> 5 A 1 p</option>
							<option value="15 A 1 p">15 A 1 p</option>
							<option value="30 A 1 p">30 A 1 p</option>
							<option value="15 A 3 p">15 A 3 p</option>
							<option value="30 A 3 p">30 A 3 p</option>
						</select>
					</div>
				</div>
				<hr />
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">วันที่ยื่นคำร้อง:</label>
					<div class="col-9">
						<input type="date" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">ผู้รับเอกสาร:</label>
					<div class="col-9">
						<select class="form-control">
							<option value="">----- กรุณาเลือก -----</option>
							<option value="เกรียงศักดิ์ คำปัน">เกรียงศักดิ์ คำปัน</option>
							<option value="เครือนรงค์ รุ่งเรือง">เครือนรงค์ รุ่งเรือง</option>
							<option value="ภมรทิพย์ เครือตา">ภมรทิพย์ เครือตา</option>
							<option value="ธนยศ กัญญาคำ">ธนยศ กัญญาคำ</option>
							<option value="อนุรักษ์ ณ เชียงใหม่">อนุรักษ์ ณ เชียงใหม่</option>
							<option value="เฉลิมเกียรติ เภตรานนท์">เฉลิมเกียรติ เภตรานนท์</option>
							<option value="กิตติพล เดโชสว่าง">กิตติพล เดโชสว่าง</option>
							<option value="วิตธาดา อินทรประสิทธิ์">วิตธาดา อินทรประสิทธิ์</option>
							<option value="ศุภชัย พันติ">ศุภชัย พันติ</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">วันที่ตรวจ:</label>
					<div class="col-9">
						<input type="date" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">ชื่อผู้ตรวจ:</label>
					<div class="col-9">
						<select class="form-control">
							<option value="">----- กรุณาเลือก -----</option>
							<option value="เกรียงศักดิ์ คำปัน">เกรียงศักดิ์ คำปัน</option>
							<option value="เครือนรงค์ รุ่งเรือง">เครือนรงค์ รุ่งเรือง</option>
							<option value="ภมรทิพย์ เครือตา">ภมรทิพย์ เครือตา</option>
							<option value="ธนยศ กัญญาคำ">ธนยศ กัญญาคำ</option>
							<option value="อนุรักษ์ ณ เชียงใหม่">อนุรักษ์ ณ เชียงใหม่</option>
							<option value="เฉลิมเกียรติ เภตรานนท์">เฉลิมเกียรติ เภตรานนท์</option>
							<option value="กิตติพล เดโชสว่าง">กิตติพล เดโชสว่าง</option>
							<option value="วิตธาดา อินทรประสิทธิ์">วิตธาดา อินทรประสิทธิ์</option>
							<option value="ศุภชัย พันติ">ศุภชัย พันติ</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-3 col-form-label">ผลการตรวจ:</label>
					<div class="col-9">
						<div class="kt-radio-inline">
							<label class="kt-radio kt-radio--solid kt-radio--success">
								<input type="radio" name="radio4"> ชำระแล้ว
								<span></span>
							</label>
							<label class="kt-radio kt-radio--solid kt-radio--brand">
								<input type="radio" name="radio4"> รอชำระค่าธรรมเนียม
								<span></span>
							</label>
							<label class="kt-radio">
								<input type="radio" name="radio4"> ไม่ผ่าน
								<span></span>
							</label>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">วันที่ชำระเงิน:</label>
					<div class="col-9">
						<input type="date" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="example-search-input" class="col-3 col-form-label">สาเหตุ:</label>
					<div class="col-9">
						<textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
					</div>
				</div>
				
			</form>	
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
			<button type="button" class="btn btn-primary">บันทึกข้อมูล</button>
		</div>
	</div>
</div>
