<?php

if (!isset($_GET['start'], $_GET['end'])) {
    die('');
}

// Include the main TCPDF library (search for installation path).
@require('../meter/config.php');
@require('../meter/class/user.php');

$user = new User();
$result = $user->authentication();

@require('../meter/class/report.php');

$report = new report();

$filter = [];
if (isset($_GET['recipient_id']) && $_GET['recipient_id']) {
    $filter['recipient_id'] = $_GET['recipient_id'];
}

$result = $report->getMetersP3($_GET['start'], $_GET['end'], $filter);
if (!$result) {
    die('ไม่พบข้อมูล');
}

@require('tcpdf.php');

class p3 extends TCPDF
{

    //Page header
    public function Header()
    {
        $THSarabunBold = TCPDF_FONTS::addTTFfont('fonts/THSarabunNew Bold.ttf', 'TrueTypeUnicode', '', 96);
        $this->SetFont($THSarabunBold, '', 11, '', true);

        $html = <<<EOD
<br><div style="width: 100%;"><b>กระบวนงาน P3 : กระบวนงานการขอใช้ไฟฟ้า การไฟฟ้าส่วนภูมิภาคสาขาอำเภอป่าซาง</b><br></div>
<table border="1" nobr="true" style="border: 1px solid;">
<thead>
    <tr>
		<td rowspan="2" style="text-align: center; width: 3%; border: 1px solid #333;">ที่</td>
		<td rowspan="2" style="text-align: center;">ผู้รับคำร้อง</td>
		<td rowspan="2" style="text-align: center;">หมายเลข<br>ผู้ใช้ไฟฟ้า</td>
		<td rowspan="2" style="text-align: center; width: 12.4%;">ชื่อผู้ใช้ไฟ</td>
		<td rowspan="2" style="text-align: center;">วันที่ชำระเงิน<br>ค่ามิเตอร์</td>
		<td colspan="2" style="text-align: center;">ส่งคำร้องติดตั้งมิเตอร์</td>
		<td colspan="4" style="text-align: center;">ส่งคำร้อง ปรับปรุง ตรวจสอบ บันทึกสายการจดหน่วย</td>
		<td colspan="2" style="text-align: center;">ส่งคำร้องจัดเก็บ</td>
	</tr>
	<tr>
	    <td style="text-align: center;">ผบค/ผบต ส่งงาน</td>
	    <td style="text-align: center;">ผมต/ผบต รับงาน</td>
	    <td style="text-align: center;">ผมต/ผบต ส่งงาน</td>
	    <td style="text-align: center;">ผบป/ผบง รับงาน</td>
	    <td style="text-align: center;">ผบป/ผบง ส่งงาน</td>
	    <td style="text-align: center;">ผมต/ผบต รับงาน</td>
	    <td style="text-align: center;">ผมต/ผบต ส่งงาน</td>
	    <td style="text-align: center;">ผบห/ผบง รับงาน</td>
	</tr>
</thead>
</table>
EOD;

        $this->writeHTML($html, true, false, false, false, 'C');
    }

    // Page footer
    public function Footer()
    {
    }
}

$pdf = new p3('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetProtection(array('modify', 'copy', 'annot-forms', 'fill-forms', 'extract', 'assemble'), '', null, 0, null);

// set document information
$pdf->SetCreator('TCPDF');
$pdf->SetAuthor('Julladaj Bleriot');
$pdf->SetTitle('PEA - Meter Form');
$pdf->SetSubject('Official Letter');
$pdf->SetKeywords('PEA, Thailand');

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT - 5, 24.3, PDF_MARGIN_RIGHT - 5);
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
<table border="1" nobr="true">
EOD;

$i = 1;
foreach ($result as $row) {
    $thai_date_payment = date_thai_format($row['date_payment']);
    $thai_date_install = date_thai_format($row['date_install']);
    $thai_meter_accept_date = date_thai_format($row['meter_accept_date']);
    $thai_meter_store_date = date_thai_format($row['meter_store_date']);
    $thai_account_receive_date = date_thai_format($row['account_receive_date']);
    $thai_account_reject_date = date_thai_format($row['account_reject_date']);
    $thai_account_accept_date = date_thai_format($row['account_accept_date']);

    $html .= <<<EOD
    <tr>
        <td style="text-align: center; width: 3%;">{$i}</td>
        <td style="text-align: center;">{$row['meter_staff_name']}</td>
        <td style="text-align: center;">{$row['pea_no']}</td>
        <td style="text-align: center; width: 12.4%;">{$row['customer_name']}</td>
        <td style="text-align: center;">{$thai_date_payment}</td>
        <td style="text-align: center;">{$thai_date_install}</td>
        <td style="text-align: center;">{$thai_meter_accept_date}</td>
        <td style="text-align: center;">{$thai_meter_store_date}</td>
        <td style="text-align: center;">{$thai_account_receive_date}</td>
        <td style="text-align: center;">{$thai_account_reject_date}</td>
        <td style="text-align: center;">{$thai_meter_accept_date}</td>
        <td style="text-align: center;">{$thai_meter_store_date}</td>
        <td style="text-align: center;">{$thai_account_accept_date}</td>
    </tr>
EOD;

    $i++;
}

$html .= <<<EOD
</table>
EOD;

$pdf->writeHTML($html, true, false, false, false, '');

//$pdf->writeHTMLCell(210 - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT + 10, '', '', $y, $html, 0, 1, 0, true, 'J', true);

//Close and output PDF document
$pdf->Output('meter_form.pdf', 'I');
