<?php
 @require_once('config.php');
	@require_once('class/meter.php');
 
 $result = array();
	$project = new _Meter();
 
 try {
  if (!isset($_POST['auto_id']) || !$_POST['auto_id']) throw new Exception('Need auto_id tp proceed!');
		if (!isset($_POST['token']) || !$_POST['token']) throw new Exception('Need token tp proceed!');

  $result = $project->deleteMeter($_POST['auto_id'], $_POST['token']);
 } catch (Exception $e) {
  $result['success'] = 0;
  $result['error'] = $e->getMessage();
 }
 
 header('Content-Type: application/json');
 echo json_encode($result);
?>