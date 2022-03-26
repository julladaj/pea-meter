<?php

if (!isset($_GET['start'], $_GET['end'])) {
    die('');
}

// Include the main TCPDF library (search for installation path).
@require('../meter/config.php');
@require('../meter/class/meter.php');

$meter = new _Meter();

$filter = [
    'start' => $_GET['start'],
    'end' => $_GET['end']
];
$result = $meter->getJSONMeter(array('filter' => json_encode($filter)));
if (!$result['total']) {
    die('ไม่พบข้อมูล');
}

function date_thai_format($strDate): string
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));

    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

function numtothaistring($num)
{
    $return_str = "";
    $txtnum1 = array('', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า');
    $txtnum2 = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
    $num_arr = str_split($num);
    $count = count($num_arr);
    foreach ($num_arr as $key => $val) {
        if ($count > 1 && $val == 1 && $key == ($count - 1)) {
            $return_str .= "เอ็ด";
        } else {
            $return_str .= $txtnum1[$val] . $txtnum2[$count - $key - 1];
        }
    }
    return $return_str;
}

function numtothai($num)
{
    if ($num === 0) {
        return "ศูนย์บาทถ้วน";
    }
    $return = "";
    $num = str_replace(",", "", $num);
    $number = explode(".", $num);
    if (count($number) > 2) {
        return 'รูปแบบข้อมุลไม่ถูกต้อง';
    }
    $return .= numtothaistring($number[0]) . "บาท";
    $stang = $number[1] ?? 0;
    $stang = (int)$stang;
    if ($stang > 0) {
        $return .= numtothaistring($stang) . "สตางค์";
    } else {
        $return .= "ถ้วน";
    }
    return $return;
}

$thai_month = array(
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

$thaiStartDate = date_thai_format($_GET['start']);
$thaiEndDate = date_thai_format($_GET['end']);

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

$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetProtection(array('modify', 'copy', 'annot-forms', 'fill-forms', 'extract', 'assemble'), '', null, 0, null);

// set document information
$pdf->SetCreator('TCPDF');
$pdf->SetAuthor('Julladaj Bleriot');
$pdf->SetTitle('PEA - Meter Form');
$pdf->SetSubject('Official Letter');
$pdf->SetKeywords('PEA, Thailand');

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT - 5, 5, PDF_MARGIN_RIGHT - 5);
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
<table border="0" style="border-collapse: collapse;">
<thead>
	<tr>
		<td colspan="25" class="b-1" style="text-align: center;"><b>{$PEA_NAME}</b>&nbsp;&nbsp;&nbsp;&nbsp;ใบสั่งจ้างประจำวันที่<u>&nbsp;&nbsp;&nbsp;&nbsp;<b>{$thaiStartDate} - {$thaiEndDate}</b>&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
	</tr>
	<tr>
		<td colspan="25" style="text-align: center;">ใบสั่งจ้างปฏิบัติงานเกี่ยวกับมิเตอร์ <span style="color: red;"><u>กรณีรื้อถอน ย้าย สับเปลี่ยน เพิ่ม/ลด ขนาดมิเตอร์</u></span> ยกเว้นกรณี งดจ่ายไฟฟ้า<span style="color: red;">(งบทำการ)</span>ตามสัญญาจ้างเลขที่<u></u></td>
	</tr>
	<tr>
		<td colspan="25" style="text-align: center;">
		(ผู้รับจ้าง)<u>&nbsp;&nbsp;&nbsp;&nbsp;<b>sdfsdfsdf</b>&nbsp;&nbsp;&nbsp;&nbsp;</u>
		</td>
	</tr>
	<tr>
		<td rowspan="2" style="text-align: center; border: 1px solid black;">ที่</td>
		<td rowspan="2" colspan="2" style="text-align: center; border: 1px solid black;">ใบสั่งจ้าง<br>ประจำวันที่</td>
		<td rowspan="2" colspan="2" style="text-align: center; border: 1px solid black;">หมายเลข<br>ผู้ใช้ไฟฟ้า</td>
		<td rowspan="2" colspan="3" style="text-align: center; border: 1px solid black;">ชื่อผู้ใช้ไฟฟ้า</td>
		<td colspan="3" style="text-align: center; border: 1px solid black;">หมายเลขฟอร์ด</td>
		<td colspan="4" style="text-align: center; border: 1px solid black;">หมายเลขมิเตอร์</td>
		<td colspan="4" style="text-align: center; border: 1px solid black;">รายละเอียดงาน<br>ที่ให้ดำเนินการ</td>
		<td rowspan="2" colspan="2" style="text-align: center; border: 1px solid black;">วันครบกำหนด<br>ส่งงาน</td>
		<td rowspan="2" colspan="2" style="text-align: center; border: 1px solid black;">วันที่<br>ส่งมอบงาน</td>
		<td rowspan="2" colspan="2" style="text-align: center; border: 1px solid black;">หมายเหตุ</td>
	</tr>
	<tr>
	    <td style="text-align: center; border: 1px solid black;">สาย</td>
	    <td colspan="2" style="text-align: center; border: 1px solid black;">หมายเลข</td>
	    <td colspan="2" style="text-align: center; border: 1px solid black;">ขนาดมิเตอร์</td>
	    <td colspan="2" style="text-align: center; border: 1px solid black;">PEA</td>
	    <td colspan="3" style="text-align: center; border: 1px solid black;">ลักษณะงาน</td>
	    <td style="text-align: center; border: 1px solid black;">ค่าจ้าง</td>
    </tr>
</thead>
<tbody>
EOD;
$i = 1;
$total = 0;
foreach ($result['items'] as $item) {
    //dd($item);
    $thaiDate = $item['date_add'] ? date_thai_format($item['date_add']) : '';
    $thaiDueDate = $item['due_date'] ? date_thai_format($item['due_date']) : '';
    $thaiDateFinish = $item['date_finish'] ? date_thai_format($item['date_finish']) : '';

    $price = $item['installation_price'] ?? 0;
    $formatted_price = number_format($price, 0);
    $total += $price;

    $fort_cable = $item['fort_cable'] ?? '';
    $meter_number = '';
    $html .= <<<EOD
<tr>
    <td style="text-align: center; border: 1px solid black;">{$i}</td>
    <td colspan="2" style="text-align: center; border: 1px solid black;">{$thaiDate}</td>
    <td colspan="2" style="text-align: center; border: 1px solid black;">{$item['number1']}</td>
    <td colspan="3" style="text-align: left; border: 1px solid black;">{$item['fname']}</td>
    <td style="text-align: center; border: 1px solid black;">{$fort_cable}</td>
    <td colspan="2" style="text-align: center; border: 1px solid black;"></td>
    <td colspan="2" style="text-align: center; border: 1px solid black;">{$item['meter_size_detail']}</td>
    <td colspan="2" style="text-align: center; border: 1px solid black;">{$meter_number}</td>
    <td colspan="3" style="text-align: center; border: 1px solid black;">{$item['job_type_name']}</td>
    <td style="text-align: right; border: 1px solid black;">{$formatted_price}</td>
    <td colspan="2" style="text-align: center; border: 1px solid black;">{$thaiDueDate}</td>
    <td colspan="2" style="text-align: center; border: 1px solid black;">{$thaiDateFinish}</td>
    <td colspan="2" style="text-align: center; border: 1px solid black;">{$item['meter_comment']}</td>
</tr>
EOD;
    $i++;
}

$totalThaiBaht = numtothai($total);
$formatted_total = number_format($total, 0);

$html .= <<<EOD
    <tr style="font-weight: bold;">
        <td colspan="3" style="text-align: right; border: 1px solid black;">รวมเงินทั้งหมด</td>
        <td colspan="14" style="text-align: center; border: 1px solid black; background-color: yellow;">{$totalThaiBaht}</td>
        <td colspan="2" style="text-align: right; border: 1px solid black;">{$formatted_total}</td>
        <td colspan="6" style="text-align: left; border: 1px solid black;">บาท</td>
    </tr>
</tbody>
</table>
EOD;

$pdf->writeHTML($html, true, false, false, false, '');

//$pdf->writeHTMLCell(210 - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT + 10, '', '', $y, $html, 0, 1, 0, true, 'J', true);

//Close and output PDF document
$pdf->Output('meter_form.pdf', 'I');
