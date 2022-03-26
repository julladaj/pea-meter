<?php
@require_once('config.php');
@require_once('class/meter.php');

$c_meter = new Meter();
$row = $c_meter->getJSONDocument($_REQUEST);

header('Content-Type: application/json');
echo json_encode($row);
?>