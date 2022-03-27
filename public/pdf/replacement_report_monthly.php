<?php

if (!isset($_GET['date'])) {
    die('');
}

// Include the main TCPDF library (search for installation path).
@require('../meter/config.php');
@require('../meter/class/user.php');

$user = new User();
$result = $user->authentication();

@require('../meter/class/report.php');

$report = new report();

$enum = $_GET['enum'] ?? '1';

$filter = [
    'date' => $_GET['date'],
    'job_type_enum' => $enum
];
$result = $report->getMonthlyReplacement($filter);
if (!$result) {
    die('ไม่พบข้อมูล');
}

$report_type = ($enum === '1') ? 'กรณีติดตั้งใหม่' : 'กรณีรื้อถอน ย้าย สับเปลี่ยน เพิ่ม/ลด ขนาดมิเตอร์';
$budget_type = ($enum === '1') ? 'งบลงทุน' : 'งบทำการ';

$meta_data = $report->getMetaData();
$contract_no = $meta_data['contract_no'] ?? '';
$contractor_name = $meta_data['contractor_name'] ?? '';
$special_ford_no = $meta_data['ford_no'] ?? [];

$time = strtotime($_GET['date']);
$first_day_of_month = date("Y-m-1", $time);
$last_day_of_month = date("Y-m-t", $time);
$last_day = (int)date("t", $time);

$total_colspan = 31 + 16; // days + extra columns
$job_type_name_colspan = 31 - $last_day + 8;

$thaiStartDate = date_thai_format($first_day_of_month);
$thaiEndDate = date_thai_format($last_day_of_month);

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
$pdf->SetFont($THSarabunNew, '', 12, '', true);

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
		<td colspan="{$total_colspan}" style="text-align: center;">สรุปค่าใช้จ่ายจ้างเหมาเกี่ยวกับมิเตอร์ประจำเดือน<u>&nbsp;&nbsp;&nbsp;&nbsp;<b>{$thaiStartDate} - {$thaiEndDate}</b>&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
	</tr>
	<tr>
		<td colspan="{$total_colspan}" style="text-align: center;"><span style="color: red;"><u>{$report_type}</u></span> ยกเว้นกรณี งดจ่ายไฟฟ้า&nbsp;<span style="color: red;">({$budget_type})</span></td>
	</tr>
	<tr>
		<td colspan="{$job_type_name_colspan}" style="text-align: center; border: 1px solid black;">รายการ</td>
		<td colspan="{$last_day}" style="text-align: center; border: 1px solid black;">วันที่ออกใบสั่งจ้าง ประจำเดือน<u>&nbsp;&nbsp;&nbsp;&nbsp;<b>{$thaiStartDate} - {$thaiEndDate}</b>&nbsp;&nbsp;&nbsp;&nbsp;</u></td>
		<td rowspan="2" colspan="2" style="text-align: center; border: 1px solid black;">รวม<br>(เครื่อง)</td>
		<td rowspan="2" colspan="3" style="text-align: center; border: 1px solid black;">ราคา/หน่วย<br>(บาท)</td>
		<td rowspan="2" colspan="3" style="text-align: center; border: 1px solid black;">เป็นเงิน<br>(บาท)</td>
	</tr>
	<tr>
		<td colspan="{$job_type_name_colspan}" style="text-align: center; border: 1px solid black; background-color: yellow;">ลักษณะงาน ปกติ</td>
EOD;
for ($i = 1; $i <= $last_day; $i++) {
    $html .= '<td style="text-align: center; border: 1px solid black;">' . $i . '</td>';
}
$html .= <<<EOD
	</tr>
</thead>
<tbody>
EOD;

$summarize = [];
$grand_total_price = 0;

foreach ($result as $row) {
    $html .= '
<tr>
<td colspan="' . $job_type_name_colspan . '" style="text-align: left; border: 1px solid black;">' . $row['job_type_name'] . '</td>';
    $row_sum = 0;
    for ($i = 1; $i <= $last_day; $i++) {
        $meter_count = $row['d_' . $i] ?? 0;
        $html .= '<td style="text-align: center; border: 1px solid black;">' . ($meter_count ?: '') . '</td>';
        $row_sum += $meter_count;

        $key_count = 'count_' . $i;
        $summarize[$key_count] = isset($summarize[$key_count]) ? $summarize[$key_count] + $meter_count : $meter_count;
        $grand_total_price += ($row['price'] * $meter_count);
    }
    $html .= '<td colspan="2" style="text-align: right; border: 1px solid black;">' . $row_sum . '</td>
<td colspan="3" style="text-align: right; border: 1px solid black;">' . number_format($row['price'], 0) . '</td>
<td colspan="3" style="text-align: right; border: 1px solid black;">' . number_format($row['price'] * $row_sum, 0) . '</td>
</tr>';
}

$html .= '<tr><td colspan="' . $job_type_name_colspan . '" style="text-align: center; border: 1px solid black; background-color: yellow;">ลักษณะงาน พื้นที่พิเศษ</td></tr>';

foreach ($result as $row) {
    $html .= '
<tr>
<td colspan="' . $job_type_name_colspan . '" style="text-align: left; border: 1px solid black;">' . $row['job_type_name'] . '</td>';
    $row_sum = 0;
    for ($i = 1; $i <= $last_day; $i++) {
        $meter_count = $row['d_s_' . $i] ?? 0;
        $html .= '<td style="text-align: center; border: 1px solid black;">' . ($meter_count ?: '') . '</td>';
        $row_sum += $meter_count;

        $key_count = 'count_' . $i;
        $summarize[$key_count] = isset($summarize[$key_count]) ? $summarize[$key_count] + $meter_count : $meter_count;
        $grand_total_price += ($row['price_special'] * $meter_count);
    }
    $html .= '<td colspan="2" style="text-align: right; border: 1px solid black;">' . $row_sum . '</td>
<td colspan="3" style="text-align: right; border: 1px solid black;">' . number_format($row['price_special'], 0) . '</td>
<td colspan="3" style="text-align: right; border: 1px solid black;">' . number_format($row['price_special'] * $row_sum, 0) . '</td>
</tr>';
}

$html .= '<tr style="font-weight: bold;">
		<td colspan="' . $job_type_name_colspan . '" style="text-align: center; border: 1px solid black;">รายการรวม</td>';

$grand_total_meter_count = 0;
for ($i = 1; $i <= $last_day; $i++) {
    $meter_count = $summarize['count_' . $i] ?? 0;
    $grand_total_meter_count += $meter_count;
    $html .= '<td style="text-align: center; border: 1px solid black;">' . number_format($meter_count, 0) . '</td>';
}

$grand_total_meter_count_formatted = number_format($grand_total_meter_count, 0);
$grand_total_price_formatted = number_format($grand_total_price, 0);

$html .= <<<EOD
		<td colspan="2" style="text-align: right; border: 1px solid black;">{$grand_total_meter_count_formatted}</td>
		<td colspan="3" style="border: 1px solid black;"></td>
		<td colspan="3" style="text-align: right; border: 1px solid black;">{$grand_total_price_formatted}</td>
	</tr>
</tbody>
</table>
EOD;

$pdf->writeHTML($html, true, false, false, false, '');

//$pdf->writeHTMLCell(210 - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT + 10, '', '', $y, $html, 0, 1, 0, true, 'J', true);

//Close and output PDF document
$pdf->Output('meter_form.pdf', 'I');
