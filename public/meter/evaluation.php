<?php

@require('config.php');
@require('class/meter.php');

$meter = new _Meter();

$result = $meter->evaluation($_POST);

header('Content-Type: application/json');
echo json_encode($result);
