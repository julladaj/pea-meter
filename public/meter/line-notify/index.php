<?php

$PEACHM01_token = 'tUNZYHJBuJlUfPWzKda0GiKM5HVyCajsPzoiMHrIVEI';
$PEACHM02_token = 'M6YvaNRBndeOGqZv1OOOMrB6UTW1fXVLdis38WAggRA';

$message = 'https://pea.g-net.co.th/meter/?id=640537';
$qr_code = 'https://qrcode.g-net.co.th/png/f42806543246709489d1687b7af96f89.png';

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
