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
        }
    } catch (Exception $e) {
        $result['success'] = 0;
        $result['error'] = $e->getMessage();
    }
}

header('Content-Type: application/json');
echo json_encode($result);
