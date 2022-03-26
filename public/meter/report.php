<?php

if (!isset($_POST['date_range'])) {
    die('กรุณาระบุวันที่');
}
list($start_date, $end_date) = explode(' to ', $_POST['date_range']);

if (!isset($_POST['form_name'])) {
    die('กรุณาระบุแบบฟอร์ม');
}

$meter_staff_id = $_POST['meter_staff_id'] ?? 1;

header('location: /pdf/' . $_POST['form_name'] . '.php?start=' . $start_date . '&end=' . $end_date . '&meter_staff_id=' . $meter_staff_id);
exit;