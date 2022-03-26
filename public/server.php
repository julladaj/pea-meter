<?php
@require_once('config.php');
@require_once('class/meter.php');
//@include('doc/api_reference/lib/class-list-util.php');

file_put_contents('log.txt', print_r($_REQUEST, true));

$c_meter = new Meter();
$row = $c_meter->getJSONMeter($_REQUEST);
file_put_contents('row.txt', print_r($row, true));



$secho = 0;
if ( isset( $_REQUEST['sEcho'] ) ) {
	$secho = intval( $_REQUEST['sEcho'] );
}

/*
$result = [
	'iTotalRecords'        => $totalRecords,
	'iTotalDisplayRecords' => $totalDisplay,
	'sEcho'                => $secho,
	'sColumns'             => '',
	'aaData'               => $data,
];
file_put_contents('log.txt', print_r($result, true));
*/

$result = [
	'iTotalRecords'        => $row['total'],
	'iTotalDisplayRecords' => $row['total'],
	'sEcho'                => $secho,
	'sColumns'             => '',
	'aaData'               => $row['items'],
];


header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

echo json_encode( $result, JSON_PRETTY_PRINT );