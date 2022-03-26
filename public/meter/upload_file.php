<?php
	@require_once('config.php');
	
	$result = array();
	
	//file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/log/log.txt', print_r($_REQUEST, true));
	
	$id = (isset($_POST['id']))? $_POST['id'] : 0;
	
	if (isset($_FILES['file'])) {
		//file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/log/log.txt', print_r($_FILES['file'], true));
			
   $image_extension = pathinfo(basename($_FILES['file']['name']), PATHINFO_EXTENSION);
			if ($image_extension != 'png') $image_extension = 'jpg';
   $target_path = DIR_UPLOAD . $id . "." . $image_extension;
			$url_name = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/upload/" . DIR_NAME . "/$id.jpg";
			
 
			if (file_exists($target_path)) {
				chmod($target_path, 0755); //Change the file permissions if allowed
				unlink($target_path); //remove the file
			}
			
			if (@move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
				if ($image_extension == 'png') {
					$image = imagecreatefrompng($target_path);
					$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
					imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
					imagealphablending($bg, TRUE);
					imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
					imagedestroy($image);
					$quality = 50; // 0 = worst / smaller file, 100 = better / bigger file 
					
					chmod($target_path, 0755); //Change the file permissions if allowed
					unlink($target_path); //remove the file
					
					$target_path = DIR_UPLOAD . $id . ".jpg";
					imagejpeg($bg, $target_path, $quality);
					imagedestroy($bg);
				}
				
				$message = "หมายเลขคำร้อง *$id* ได้ทำการแนบหลักฐานการชำระเงิน\nสามารถตรวจสอบเอกสารได้ที่\n$url_name";
				//$qr_code = 'https://qrcode.g-net.co.th/png/f42806543246709489d1687b7af96f89.png';
				$line_token = LINE_TOKEN;
				$command = <<<EOD
curl -X POST -H 'Authorization: Bearer {$line_token}' -F 'message={$message}' -F 'imageThumbnail={$url_name}' -F 'imageFullsize={$url_name}' https://notify-api.line.me/api/notify
EOD;
	
				$command = <<<EOD
curl -X POST -H 'Authorization: Bearer {$line_token}' -F 'message={$message}' https://notify-api.line.me/api/notify
EOD;
				
				exec($command, $result);

				$result = array(
					'success' => 1,
					'url' => $url_name . '?t=' . time()
				);
   }
	}
	
	header('Content-Type: application/json');
	echo json_encode($result);
?>