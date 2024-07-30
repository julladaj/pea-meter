<?php

@require_once('config.php');

$result = array();

//file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/log/log.txt', print_r($_REQUEST, true));

$id = $_POST['id'] ?? 0;
$file_name = ($_POST['file_name'] ?? $id);
$lineNotification = (int)($_POST['lineNotification'] ?? 1);

if (isset($_FILES['file'])) {
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log/log.txt', "Log Clear!\n");
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log/log.txt', "\n" . print_r($_FILES['file'], true), FILE_APPEND);

    $image_extension = pathinfo(basename($_FILES['file']['name']), PATHINFO_EXTENSION);
    if ($image_extension !== 'png') {
        $image_extension = 'jpg';
    }
    $target_path = DIR_UPLOAD . $file_name . "." . $image_extension;
    $url_name = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/upload/" . DIR_NAME . "/$file_name.jpg?t=" . time();

    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log/log.txt', "\n" . __FILE__ . ' | Line: ' . __LINE__ . "\n" . '$target_path: ' . print_r($target_path, true), FILE_APPEND);
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log/log.txt', "\n" . __FILE__ . ' | Line: ' . __LINE__ . "\n" . '$url_name: ' . print_r($url_name, true), FILE_APPEND);

    if (file_exists($target_path)) {
        $result = chmod($target_path, 0755); //Change the file permissions if allowed
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log/log.txt', "\n" . __FILE__ . ' | Line: ' . __LINE__ . "\n" . '$result: ' . print_r($result, true), FILE_APPEND);

        $result = unlink($target_path); //remove the file
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log/log.txt', "\n" . __FILE__ . ' | Line: ' . __LINE__ . "\n" . '$result: ' . print_r($result, true), FILE_APPEND);
    }

    try {
        $result = move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log/log.txt', "\n" . __FILE__ . ' | Line: ' . __LINE__ . "\n" . '$result: ' . print_r($result, true), FILE_APPEND);
    } catch (\Exception $e) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log/log.txt', "\n" . __FILE__ . ' | Line: ' . __LINE__ . "\n" . '$e: ' . $e->getMessage(), FILE_APPEND);
    }

    if ($result) {
        if ($image_extension === 'png') {
            $image = imagecreatefrompng($target_path);
            $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
            imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
            imagealphablending($bg, true);
            imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
            imagedestroy($image);
            $quality = 50; // 0 = worst / smaller file, 100 = better / bigger file

            chmod($target_path, 0755); //Change the file permissions if allowed
            unlink($target_path); //remove the file

            $target_path = DIR_UPLOAD . $file_name . ".jpg";
            imagejpeg($bg, $target_path, $quality);
            imagedestroy($bg);
        }

        $message = "หมายเลขคำร้อง *$id* ได้ทำการแนบหลักฐานการชำระเงิน\nสามารถตรวจสอบเอกสารได้ที่\n$url_name";
        //$qr_code = 'https://qrcode.g-net.co.th/png/f42806543246709489d1687b7af96f89.png';
        $line_token = LINE_TOKEN;
//        $command = <<<EOD
//curl -X POST -H 'Authorization: Bearer {$line_token}' -F 'message={$message}' -F 'imageThumbnail={$url_name}' -F 'imageFullsize={$url_name}' https://notify-api.line.me/api/notify
//EOD;

        $command = <<<EOD
curl -X POST -H 'Authorization: Bearer {$line_token}' -F 'message={$message}' https://notify-api.line.me/api/notify
EOD;

        if (defined('LINE_NOTIFICATION') && LINE_NOTIFICATION && $lineNotification) {
            exec($command, $result);
            $result['line_success'] = 1;
        }

        $result = array(
            'success' => 1,
            'url' => $url_name
        );
    }
}

header('Content-Type: application/json');
echo json_encode($result);
?>