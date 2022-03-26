<?php
@require_once('config.php');
@require_once('class/meter.php');

$meter = new _Meter();
$row = $meter->getJSONMeter($_REQUEST);

header('Content-Type: application/json');
echo json_encode($row);
?>