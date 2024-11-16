<?php
if (!isset($_GET['id'], $_GET['token'])) {
    die('');
}

// Include the main TCPDF library (search for installation path).
@require('../meter/config.php');
@require('../meter/class/meter.php');

$meter = new _Meter();

$data = array();
$filter = array('auto_id' => $_GET['id'], 'token' => $_GET['token']);
$result = $meter->getJSONMeter(array('filter' => json_encode($filter)));

if ($result['total']) {
    $data = $result['items'][0];
}

@require('tcpdf.php');

class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
    }

    // Page footer
    public function Footer()
    {
    }

}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetProtection(array('modify', 'copy', 'annot-forms', 'fill-forms', 'extract', 'assemble'), '', null, 0, null);

// set document information
$pdf->SetCreator('TCPDF');
$pdf->SetAuthor('Julladaj Bleriot');
$pdf->SetTitle('PEA - Meter Form');
$pdf->SetSubject('Official Letter');
$pdf->SetKeywords('PEA, Thailand');

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT - 5, 0, PDF_MARGIN_RIGHT - 5);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// set auto page breaks
$pdf->SetAutoPageBreak(true, 20);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------

$THSarabunNew = TCPDF_FONTS::addTTFfont('fonts/THSarabunNew.ttf', 'TrueTypeUnicode', '', 96);
$THSarabunBold = TCPDF_FONTS::addTTFfont('fonts/THSarabunNew Bold.ttf', 'TrueTypeUnicode', '', 96);
$pdf->SetFont($THSarabunNew, '', 14, '', true);

$pdf->AddPage();

$PEA_NAME = ACCOUNT_NAME;

$PEA_PHONE = PEA_PHONE;
$PEA_METER_PHONE = PEA_METER_PHONE;
$PEA_EXTRA_PHONE = PEA_EXTRA_PHONE;

$y = 10;
$html = <<<EOD
<table border="0" cellpadding="2" cellspacing="0">
<thead>
	<tr>
		<td colspan="2" rowspan="2" style="border-top: 1px solid black; border-left: 1px solid black;"><img src="/upload/pea_logo_100x100.jpg" /></td>
		<td colspan="5" style="border-top: 1px solid black;"></td>
		<td colspan="5" style="border-left: 1px solid black; border-top: 1px solid black; border-right: 1px solid black;"></td>
 </tr>
	<tr>
  <td colspan="5" style="text-indent: 5mm;"><b style="text-indent: 5mm;">ใบนัดตรวจสอบระบบไฟฟ้า<br>{$PEA_NAME}<br>{$PEA_PHONE}</b></td>
		<td colspan="5" style="border-left: 1px solid black; border-right: 1px solid black;">เลขที่คำร้อง..............................................................<br>วันที่รับคำร้อง..........................................................<br>ผู้รับคำร้อง...............................................................</td>
 </tr>
</thead>
<tr>
	<td colspan="12" style="text-indent: 5mm; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;">1. ผู้ขอใช้ไฟ...........................................................โทร.....................................................หมายเลขผู้ใช้ไฟฟ้า............................................</td>
</tr>
<tr>
	<td colspan="12" style="text-indent: 5mm; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;">2. เอกสารที่ต้องเตรียมมาใช้เป็นหลักฐานเพิ่มเติมในวันชำระเงิน<br>อาการแสตมป์.........บาท, สำเนาโฉนด............ชุด , สัญญาซื้อขาย........ชุด , สัญญาเช่า.........ชุด,  สำเนาทะเบียนบ้านที่ขอใช้ไฟ.........ชุด<br>สำเนาบัตรประชาชน ผู้ขอใช้ไฟ/ผู้มอบอำนาจ.........ชุด , สำเนาบัตรประชาชน ผู้รับมอบอำนาจ.........ชุด<br>สำเนาทะเบียนบ้านที่อยู่ปัจจุบันผู้ขอใช้ไฟ/ผู้มอบอำนาจ.........ชุด , สำเนาทะเบียนบ้านที่อยู่ปัจจุบันผู้รับมอบอำนาจ.........ชุด<br>สำเนาหนังสือรับรองบริษัทฯ ไม่เกิน 3 เดือน .........ชุด , อื่นๆ.....................................................................................................................</td>
</tr>
<tr>
	<td colspan="12" style="text-indent: 5mm; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;">3. นัดตรวจสอบระบบไฟฟ้า วันที่ ......................เวลา 09.00–16.30 น. พนักงานตรวจคำร้อง........................................โทร. ..................<br>กฟภ. จะตรวจการเดินสายไฟฟ้าและติดตั้งอุปกรณ์ไฟฟ้าภายในก่อนการติดตั้งมิเตอร์ โดยผู้ขอใช้ไฟฟ้าหรือผู้ใช้ไฟฟ้า ต้องติดตามต่อนัดหมาย<br>ล่วงหน้าหากมีการตรวจตามวันนัดหมาย ๒ ครั้งแล้ว การติดตั้งอุปกรณ์ไฟฟ้าภายในยังไม่ถูกต้องครบถ้วนตามที่ได้แจ้งแก้ไขไปแล้ว<br>กฟภ. จะเรียกเก็บค่าตรวจเพิ่มเติมสำหรับการตรวจในครั้งต่อไป<br>ประเภทคำร้อง...................................................ขนาดมิเตอร์......................................... รวมเป็นเงินเครื่องละ .......................................บาท<br>ผลการตรวจสอบมาตรฐานการติดตั้งทางไฟฟ้า ***กรณีขยายเขตระบบจำหน่ายไฟฟ้า สอบถามสถานะงานขยายเขต โทร {$PEA_EXTRA_PHONE}<br>ครั้งที่1        ผ่าน         ไม่ผ่าน ให้แก้ไขดังนี้.........................................................................................................................................................<br>ครั้งที่2        ผ่าน         ไม่ผ่าน ให้แก้ไขดังนี้......................................................................................................................................................... </td>
</tr>
<tr>
	<td colspan="7" style="text-indent: 5mm; border-left: 1px solid black; border-top: 1px solid black;">4. พิกัดขนาดสายเมนประธานแบบเดินลอย และเครื่องป้องกันกระแสเกิน</td>
	<td colspan="5" rowspan="2" style="border-top: 1px solid black; border-right: 1px solid black;"><img src="/upload/meter_standard.jpg" /></td>
</tr>
<tr>
	<td colspan="7" style="font-size: 14px; border-left: 1px solid black;"><table border="1" cellpadding="2" cellspacing="0" style="text-align:center;">
			<tr>
				<td rowspan="3">ขนาดมิเตอร์<br>(A)</td>
				<td rowspan="3">โหลดสูงสุด<br>(A)</td>
				<td rowspan="2" colspan="2">ขนาดสายเล็กที่สุด<br>(mm<sup>2</sup>)</td>
				<td colspan="3">เครื่องป้องกันกระแสเกิน</td>
			</tr>
			<tr>
				<td colspan="2">คัทเอาต์<br>ใช้ร่วมกับฟิวส์</td>
				<td>เซอร์กิต<br>เบรกเกอร์</td>
			</tr>
			<tr>
				<td>อะลูมิเนียม</td>
				<td>ทองแดง</td>
				<td>ขนาดคัทเอาต์<br>ต่ำสุด (A)</td>
				<td>ขนาดฟิวส์<br>สูงสุด (A)</td>
				<td>ขนาดปรับตั้ง<br>สูงสุด (A)</td>
			</tr>
			<tr>
				<td>5 (15)</td>
				<td>12</td>
				<td>10</td>
				<td>4</td>
				<td>20</td>
				<td>16</td>
				<td>32</td>
			</tr>
			<tr>
				<td>15 (45)</td>
				<td>36</td>
				<td>25</td>
				<td>10</td>
				<td>-</td>
				<td>-</td>
				<td>50</td>
			</tr>
			<tr>
				<td>30 (100)</td>
				<td>80</td>
				<td>50</td>
				<td>35</td>
				<td>-</td>
				<td>-</td>
				<td>100</td>
			</tr>
		</table><br>*ห้ามใช้สายอลูมิเนียมเดินร้อยท่อ และภายในอาคาร, ห้ามใช้สาย IEC01(THW) เดินร้อยท่อฝังดิน<br>*กรณีเดินร้อยท่อฝังดินให้ใช้สาย XLPE (CV) หรือ NYY    <br>*กรณีขอมิเตอร์ขนาด 30 (100)A แนบตารางโหลดการใช้ไฟฟ้า</td>
</tr>
<tr>
	<td colspan="6" style="text-indent: 5mm; border: 1px solid black;">5. ค่าธรรมเนียมการติดตั้งมิเตอร์<br><b>มิเตอร์ถาวร</b><br><table border="1" cellpadding="1" cellspacing="0" style="text-align:center;font-size: 14px;">
		<tr>
			<td><b>ขนาดมิเตอร์</b></td>
			<td><b>ระบบเฟส</b></td>
			<td><b>ค่าตรวจสอบ</b></td>
			<td><b>รวม (บาท)</b></td>
		</tr>
		<tr>
			<td>5 (15)</td>
			<td>1</td>
			<td style="text-align:right;">107.-</td>
			<td style="text-align:right;">107.-</td>
		</tr>
		<tr>
			<td>15 (45)</td>
			<td>1</td>
			<td style="text-align:right;">749.-</td>
			<td style="text-align:right;">749.-</td>
		</tr>
		<tr>
			<td>30 (100)</td>
			<td>1</td>
			<td style="text-align:right;">749.-</td>
			<td style="text-align:right;">749.-</td>
		</tr>
		<tr>
			<td>15 (45)</td>
			<td>3</td>
			<td style="text-align:right;">749.-</td>
			<td style="text-align:right;">749.-</td>
		</tr>
		<tr>
			<td>30 (100)</td>
			<td>3</td>
			<td style="text-align:right;">1,605.-</td>
			<td style="text-align:right;">1,605.-</td>
		</tr>
		</table><br><b>มิเตอร์ชั่วคราว</b><br><table border="1" cellpadding="1" cellspacing="0" style="text-align:center;font-size: 14px;">
		<tr>
			<td><b>ขนาดมิเตอร์</b></td>
			<td><b>ระบบเฟส</b></td>
			<td><b>ค่าประกันการใช้ไฟ</b></td>
			<td><b>รวม (บาท)</b></td>
		</tr>
		<tr>
			<td>5 (15)</td>
			<td>1</td>
			<td style="text-align:right;">600.-</td>
			<td style="text-align:right;">600.-</td>
		</tr>
		<tr>
			<td>15 (45)</td>
			<td>1</td>
			<td style="text-align:right;">4,000.-</td>
			<td style="text-align:right;">4,000.-</td>
		</tr>
		<tr>
			<td>15 (45)</td>
			<td>3</td>
			<td style="text-align:right;">12,000.-</td>
			<td style="text-align:right;">12,000.-</td>
		</tr>
		</table>
	</td>
	<td colspan="6" style="border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;">
		<span style="font-size: 14px;">ชำระเงินที่สำนักงาน เวลา 08.30 -15.30 น. วันทำการ วันจันทร์-วันศุกร์ หรือ ผ่านช่องทางออนไลน์ตาม QR CODE หรือ ผ่านเลขบัญชีธนาคารกรุงไทย<br>ท่านสามารถติดตามสถานะคำร้องได้ตาม QR Code  ติดตามสถานะคำร้อง หรือ ชำระเงินแล้วสอบถามวันติดตั้งมิเตอร์  ได้ที่แผนกมิเตอร์ โทร {$PEA_METER_PHONE}</span>
	</td>
</tr>
</table>
EOD;

$pdf->writeHTMLCell(210 - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT + 10, '', '', $y, $html, 0, 1, 0, true, 'J', true);

$x = 145;
$y = 17;
$html = <<<EOD
<b style="font-size: 16px; font-weight: 900;">{$data['auto_id']}</b>
EOD;
$pdf->writeHTMLCell(40, '', $x, $y, $html, 0, 1, 0, true, 'J', true);

$date_add = (isset($data['date_add'])) ? date_thai_format($data['date_add']) : '';
$y = 23;
$html = <<<EOD
<b style="font-size: 16px; font-weight: 900;">{$date_add}</b>
EOD;
$pdf->writeHTMLCell(40, '', $x, $y, $html, 0, 1, 0, true, 'J', true);

$y = 29;
$html = <<<EOD
<b style="font-size: 16px; font-weight: 900;">{$data['recipient_name']}</b>
EOD;
$pdf->writeHTMLCell(40, '', $x, $y, $html, 0, 1, 0, true, 'J', true);

$x = 35;
$y = 42;
$html = <<<EOD
<b style="font-size: 16px; font-weight: 900;">{$data['fname']}</b>
EOD;
$pdf->writeHTMLCell(40, '', $x, $y, $html, 0, 1, 0, true, 'J', true);

$x = 88;
$y = 42;
$html = <<<EOD
<b style="font-size: 16px; font-weight: 900;">{$data['telephone']}</b>
EOD;
$pdf->writeHTMLCell(40, '', $x, $y, $html, 0, 1, 0, true, 'J', true);

$x = 154;
$y = 42;
$html = <<<EOD
<b style="font-size: 16px; font-weight: 900;">{$data['number1']}</b>
EOD;
$pdf->writeHTMLCell(40, '', $x, $y, $html, 0, 1, 0, true, 'J', true);

$date_appoint = (isset($data['date_appoint'])) ? date_thai_format($data['date_appoint']) : '';
$x = 59;
$y = 81;
$html = <<<EOD
<b style="font-size: 16px; font-weight: 900;">{$date_appoint}</b>
EOD;
$pdf->writeHTMLCell(40, '', $x, $y, $html, 0, 1, 0, true, 'J', true);

$x = 136;
$y = 81;
$html = <<<EOD
<b style="font-size: 16px; font-weight: 900;">{$data['officer_name']}</b>
EOD;
$pdf->writeHTMLCell(40, '', $x, $y, $html, 0, 1, 0, true, 'J', true);

$x = 32;
$y = 106;
$html = <<<EOD
<b style="font-size: 16px; font-weight: 900;">{$data['meter_category_detail']}</b>
EOD;
$pdf->writeHTMLCell(50, '', $x, $y, $html, 0, 1, 0, true, 'J', true);

$x = 94;
$y = 106;
$html = <<<EOD
<b style="font-size: 16px; font-weight: 900;">{$data['meter_size_detail']}</b>
EOD;
$pdf->writeHTMLCell(40, '', $x, $y, $html, 0, 1, 0, true, 'J', true);

$payment_value = number_format($data['payment_value'], 2);
$x = 156;
$y = 106;
$html = <<<EOD
<b style="font-size: 16px; font-weight: 900;">{$payment_value}</b>
EOD;
$pdf->writeHTMLCell(40, '', $x, $y, $html, 0, 1, 0, true, 'J', true);

$x = 110;
$y = 225;
$html = <<<EOD
<b style="font-size: 16px; font-weight: 900;">QR CODE ติดตามสถานะคำร้อง</b>
EOD;
$pdf->writeHTMLCell(80, '', $x, $y, $html, 0, 1, 0, true, 'J', true);

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/meter/?id=" . $_GET['id'];
$style = array(
    'border' => 0,
    'vpadding' => '0',
    'hpadding' => '0',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false, //array(255, 255, 255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);
$pdf->write2DBarcode($actual_link, 'QRCODE,L', 115, 232, 30, 30, $style, 'N');

$x = 110;
$y = 265;
$html = <<<EOD
<a href="$actual_link">$actual_link</a>
EOD;
$pdf->writeHTMLCell(80, '', $x, $y, $html, 0, 1, 0, true, 'J', true);

//Close and output PDF document
$pdf->Output('meter_form.pdf', 'I');
?>
