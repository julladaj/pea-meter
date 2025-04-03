<?php

@require_once('../config.php');

$message = 'ทดสอบการส่งข้อความอัตโนมัติผ่านไลน์';
//$qr_code = 'https://qrcode.g-net.co.th/png/77e62276bb568665f5f39bac8347b545.png';

$token = LINE_TOKEN;

$dataStructure = [
    "to" => LINE_GROUP_ID,
    "messages" => [
        [
            "type" => "text",
            "text" => $message,
        ]
    ]
];

// Convert to JSON safely
$json = json_encode($dataStructure, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

$command = <<<EOD
curl -v -X POST https://api.line.me/v2/bot/message/push \
-H 'Content-Type: application/json' \
-H 'Authorization: Bearer {$token}' \
-d '{$json}'
EOD;

if (defined('LINE_NOTIFICATION') && LINE_NOTIFICATION) {
    exec($command, $result);
    print_r($result);
}
