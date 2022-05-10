<?php

if (!isset($_GET['start'], $_GET['end'])) {
    die('');
}

// Include the main TCPDF library (search for installation path).
@require('../meter/config.php');
@require('../meter/class/user.php');

$user = new User();
$result = $user->authentication();

@require('../meter/class/meter.php');

$meter = new _Meter();

$enum = $_GET['enum'] ?? '1';

$filter = [
    'date_workorder_start' => $_GET['start'],
    'date_workorder_end' => $_GET['end'],
    'job_type_enum' => $enum
];
if (isset($_GET['recipient_id']) && $_GET['recipient_id']) {
    $filter['recipient_id'] = $_GET['recipient_id'];
}

$result = $meter->getJSONMeter(array('filter' => json_encode($filter)));
if (!$result['total']) {
    die('ไม่พบข้อมูล');
}

$report_type = ($enum === '1') ? 'กรณีติดตั้งใหม่' : 'กรณีรื้อถอน ย้าย สับเปลี่ยน เพิ่ม/ลด ขนาดมิเตอร์';
$budget_type = ($enum === '1') ? 'งบลงทุน' : 'งบทำการ';

$meta_data = $meter->getMetaData();
$contract_no = $meta_data['contract_no'] ?? '';
$contractor_name = $meta_data['contractor_name'] ?? '';
$special_ford_no = $meta_data['ford_no'] ?? [];

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
$pdf->SetFont($THSarabunNew, '', 10, '', true);

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
		<td colspan="25" style="text-align: center;">ใบสั่งจ้างปฏิบัติงานเกี่ยวกับมิเตอร์ <span style="color: red;"><u>{$report_type}</u></span> ยกเว้นกรณี งดจ่ายไฟฟ้า&nbsp;<span style="color: red;">({$budget_type})</span>&nbsp;ตามสัญญาจ้างเลขที่<u>&nbsp;{$contract_no}&nbsp;</u></td>
	</tr>
	<tr>
		<td colspan="25" style="text-align: center;">
		(ผู้รับจ้าง)<u>&nbsp;&nbsp;&nbsp;&nbsp;<b>{$contractor_name}</b>&nbsp;&nbsp;&nbsp;&nbsp;</u>
		</td>
	</tr>
	<tr>
		<td rowspan="2" style="text-align: center; border: 1px solid black;">ที่</td>
		<td rowspan="2" colspan="2" style="text-align: center; border: 1px solid black;">ใบสั่งจ้าง<br>ประจำวันที่</td>
		<td rowspan="2" colspan="2" style="text-align: center; border: 1px solid black;">หมายเลข<br>ผู้ใช้ไฟฟ้า</td>
		<td rowspan="2" colspan="3" style="text-align: center; border: 1px solid black;">ชื่อผู้ใช้ไฟฟ้า</td>
		<td colspan="4" style="text-align: center; border: 1px solid black;">หมายเลขฟอร์ด</td>
		<td colspan="3" style="text-align: center; border: 1px solid black;">หมายเลขมิเตอร์</td>
		<td colspan="4" style="text-align: center; border: 1px solid black;">รายละเอียดงาน<br>ที่ให้ดำเนินการ</td>
		<td rowspan="2" colspan="2" style="text-align: center; border: 1px solid black;">วันครบกำหนด<br>ส่งงาน</td>
		<td rowspan="2" colspan="2" style="text-align: center; border: 1px solid black;">วันที่<br>ส่งมอบงาน</td>
		<td rowspan="2" colspan="2" style="text-align: center; border: 1px solid black;">หมายเหตุ</td>
	</tr>
	<tr>
	    <td colspan="2" style="text-align: center; border: 1px solid black;">สาย</td>
	    <td colspan="2" style="text-align: center; border: 1px solid black;">หมายเลข</td>
	    <td style="text-align: center; border: 1px solid black;">ขนาด<br>มิเตอร์</td>
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
    $thaiDateWorkOrder = $item['date_workorder'] ? date_thai_format($item['date_workorder']) : '';
    $thaiDueDate = $item['due_date'] ? date_thai_format($item['due_date']) : '';
    $thaiDateFinish = $item['date_finish'] ? date_thai_format($item['date_finish']) : '';

    $fort_cable = $item['fort_cable'] ?? '';
    $fort_no = $item['fort_no'] ?? '';

    // @TODO: need it later
    $meter_number = '';

    if ($is_special_ford_no = in_array($fort_cable, $special_ford_no, true)) {
        $price = $item['installation_price_special'] ?? 0;
    } else {
        $price = $item['installation_price'] ?? 0;
    }

//    $highlight = $is_special_ford_no ? 'background-color: yellow;' : '';
    $highlight = '';

    $formatted_price = number_format($price, 0);
    $total += $price;

    $html .= <<<EOD
<tr>
    <td style="text-align: center; border: 1px solid black;">{$i}</td>
    <td colspan="2" style="text-align: center; border: 1px solid black;">{$thaiDateWorkOrder}</td>
    <td colspan="2" style="text-align: center; border: 1px solid black;">{$item['number1']}</td>
    <td colspan="3" style="text-align: left; border: 1px solid black;">{$item['fname']}</td>
    <td colspan="2" style="text-align: center; border: 1px solid black; {$highlight}">{$fort_cable}</td>
    <td colspan="2" style="text-align: center; border: 1px solid black;">{$fort_no}</td>
    <td style="text-align: center; border: 1px solid black;">{$item['meter_size_detail']}</td>
    <td colspan="2" style="text-align: center; border: 1px solid black;">{$meter_number}</td>
    <td colspan="3" style="text-align: center; border: 1px solid black;">{$item['job_type_name']}</td>
    <td style="text-align: right; border: 1px solid black; {$highlight}">{$formatted_price}</td>
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
    <tr style="font-weight: bold;" nobr="true">
        <td colspan="3" style="text-align: right; border: 1px solid black;">รวมเงินทั้งหมด</td>
        <td colspan="14" style="text-align: center; border: 1px solid black;">{$totalThaiBaht}</td>
        <td colspan="2" style="text-align: right; border: 1px solid black;">{$formatted_total}</td>
        <td colspan="6" style="text-align: left; border: 1px solid black;">บาท</td>
    </tr>
    <tr nobr="true">
        <td colspan="25" style="text-align: center;">
            <table nobr="true">
                <tr nobr="true"><td colspan="25">&nbsp;</td></tr>
                <tr nobr="true"><td colspan="25">&nbsp;</td></tr>
                <tr nobr="true">
                    <td colspan="3" style="text-align: right;">(ลงชื่อ)</td>
                    <td colspan="5" style="text-align: center; border-bottom: 0.5px dotted black;"></td>
                    <td colspan="6" style="text-align: left;">ผู้สั่งจ้าง</td>
                    <td colspan="3" style="text-align: right;">(ลงชื่อ)</td>
                    <td colspan="5" style="text-align: center; border-bottom: 0.5px dotted black;"><b>{$contractor_name}</b></td>
                    <td colspan="3" style="text-align: left;">ผู้รับจ้าง</td>
                </tr>
                <tr nobr="true">
                    <td colspan="3" style="text-align: right;">(</td>
                    <td colspan="5" style="text-align: center; border-bottom: 0.5px dotted black;"></td>
                    <td colspan="6" style="text-align: left;">)</td>
                    <td colspan="3" style="text-align: right;">(</td>
                    <td colspan="5" style="text-align: center; border-bottom: 0.5px dotted black;"></td>
                    <td colspan="3" style="text-align: left;">)</td>
                </tr>
                <tr nobr="true">
                    <td colspan="3" style="text-align: right;">ลว.</td>
                    <td colspan="5" style="text-align: center; border-bottom: 0.5px dotted black;"></td>
                    <td colspan="6" style="text-align: left;"></td>
                    <td colspan="3" style="text-align: right;">ลว.</td>
                    <td colspan="5" style="text-align: center; border-bottom: 0.5px dotted black;"></td>
                    <td colspan="3" style="text-align: left;"></td>
                </tr>
            </table>
        </td>
    </tr>
</tbody>
</table>
EOD;

$pdf->writeHTML($html, true, false, false, false, '');

//$pdf->writeHTMLCell(210 - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT + 10, '', '', $y, $html, 0, 1, 0, true, 'J', true);

//Close and output PDF document
$pdf->Output('meter_form.pdf', 'I');
