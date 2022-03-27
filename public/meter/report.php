<?php

if (!isset($_POST['date_range'])) {
    die('กรุณาระบุวันที่');
}
[$start_date, $end_date] = explode(' to ', $_POST['date_range']);

if (!isset($_POST['form_name'])) {
    die('กรุณาระบุแบบฟอร์ม');
}
switch ($_POST['form_name']) {
    case 'replacement_report':
        header('location: /pdf/replacement_report.php?start=' . $start_date . '&end=' . $end_date . '&enum=1');
        break;
    case 'replacement_report2':
        header('location: /pdf/replacement_report.php?start=' . $start_date . '&end=' . $end_date . '&enum=2');
        break;
    case 'replacement_report_monthly':
        header('location: /pdf/replacement_report_monthly.php?date=' . $start_date . '&enum=1');
        break;
    case 'replacement_report_monthly2':
        header('location: /pdf/replacement_report_monthly.php?date=' . $start_date . '&enum=2');
        break;
}
exit;