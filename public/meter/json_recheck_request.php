<?php
	@require_once('config.php');
	@require_once('class/meter.php');
 
 $result = array();
	$meter = new _Meter();
	
	//file_put_contents("log/log.txt", print_r($_REQUEST, true));
	
	if (isset($_POST['id']) && $_POST['id']) {
		try {
			$id = $_POST['id'];
			
			$result = $meter->recheck_request($id);

			$message = "หมายเลขคำร้อง *$id*\nได้ทำการแก้ไขแล้วเสร็จ และขอนัดตรวจใหม่";
		//$qr_code = 'https://qrcode.g-net.co.th/png/f42806543246709489d1687b7af96f89.png';
			$line_token = LINE_TOKEN;

			$command = <<<EOD
curl -X POST -H 'Authorization: Bearer {$line_token}' -F 'message={$message}' https://notify-api.line.me/api/notify
EOD;
	
			exec($command, $result);
		} catch (Exception $e) {
			$result['success'] = 0;
			$result['error'] = $e->getMessage();
		}
	}

	header('Content-Type: application/json');
 echo json_encode($result);
?>