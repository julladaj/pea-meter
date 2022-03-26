<?php
	$PEACHM01_token = 'tUNZYHJBuJlUfPWzKda0GiKM5HVyCajsPzoiMHrIVEI';
	$PEACHM02_token = 'M6YvaNRBndeOGqZv1OOOMrB6UTW1fXVLdis38WAggRA';
	
	$message = 'https://pea.g-net.co.th/meter/?id=640537';
	$qr_code = 'https://qrcode.g-net.co.th/png/f42806543246709489d1687b7af96f89.png';
	$command = <<<EOD
curl -X POST -H 'Authorization: Bearer {$PEACHM02_token}' -F 'message={$message}' -F 'imageThumbnail={$qr_code}' -F 'imageFullsize={$qr_code}' https://notify-api.line.me/api/notify
EOD;
	
	exec($command, $result);
	print_r($result);
?>