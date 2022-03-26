<?php

if (!isset($_POST['date_range'])) {
    die('กรุณาระบุวันที่');
}
list($start_date, $end_date) = explode(' to ', $_POST['date_range']);

if (!isset($_POST['form_name'])) {
    die('กรุณาระบุแบบฟอร์ม');
}

header('location: /pdf/' . $_POST['form_name'] . '.php?start=' . $start_date . '&end=' . $end_date);
exit;