<?php

define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'chai-van-pea');
define('DB_PASSWORD', 'u3a2epe7a');

switch ($_SERVER['SERVER_NAME']) {
    case 'pea-meter.com':
    case 'peachm02.pea-meter.com':
        define('DB_DATABASE', 'chai-van_pea');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาคจังหวัดเชียงใหม่ 2');
        define('DIR_NAME', 'PEACHM02');
        define('DIR_UPLOAD', '/var/www/pea-meter.com/public_html/upload/PEACHM02/');
        define('LINE_TOKEN', 'M6YvaNRBndeOGqZv1OOOMrB6UTW1fXVLdis38WAggRA');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค จังหวัดเชียงใหม่ 2');
        define('ACCOUNT_NO', '547-0-45597-1');
        define('PEA_PHONE', 'โทร 053-896020');
        define('PEA_METER_PHONE', '053-896125');
        define('PEA_EXTRA_PHONE', '053-896020');
        break;
    case 'peachm01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peachm01');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาคจังหวัดเชียงใหม่');
        define('DIR_NAME', 'PEACHM01');
        define('DIR_UPLOAD', '/var/www/pea-meter.com/public_html/upload/PEACHM01/');
        define('LINE_TOKEN', 'tUNZYHJBuJlUfPWzKda0GiKM5HVyCajsPzoiMHrIVEI');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค จังหวัดเชียงใหม่');
        define('ACCOUNT_NO', '501-1-13664-7');
        define('PEA_PHONE', 'โทร 053-266-422 , 053-241-266');
        define('PEA_METER_PHONE', '053-243064');
        define('PEA_EXTRA_PHONE', '053-241266');
        break;
    case 'peahad16.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peahad16');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาค อำเภอหางดง จังหวัดเชียงใหม่');
        define('DIR_NAME', 'PEAHAD16');
        define('DIR_UPLOAD', '/var/www/pea-meter.com/public_html/upload/PEAHAD16/');
        define('LINE_TOKEN', 'vP9b4mn2kB43qFXwZtDhqgjzYVUwI2UigddmTFQFZyi');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค อำเภอหางดง');
        define('ACCOUNT_NO', '538-1-11485-0');
        define('PEA_PHONE', 'โทร 0-5344-1776');
        define('PEA_METER_PHONE', '0-5310-6703');
        define('PEA_EXTRA_PHONE', '0-5344-1776');
        break;
    case 'peapas23.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peapas23');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาค อำเภอป่าซาง จังหวัดลำพูน');
        define('DIR_NAME', 'PEAPAS23');
        define('DIR_UPLOAD', '/var/www/pea-meter.com/public_html/upload/PEAPAS23/');
        define('LINE_TOKEN', '9ihMnG84Fvm5eJ64BttXLN4IKRUIiOipL2LHpTuk2yA');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค อำเภอป่าซาง');
        define('ACCOUNT_NO', '798-0-01616-5');
        define('PEA_PHONE', 'โทร 053-520-636');
        define('PEA_METER_PHONE', '053-520-636');
        define('PEA_EXTRA_PHONE', '053-555-381');
        break;
    case 'peadst01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peadst01');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาค อำเภอดอยสะเก็ด จังหวัดเชียงใหม่');
        define('DIR_NAME', 'PEADST01');
        define('DIR_UPLOAD', '/var/www/pea-meter.com/public_html/upload/PEADST01/');
        define('LINE_TOKEN', 'ryMweSHqxun4y3spS6oVL4tcx21X0oT5NC4KhaXfH9j');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค สาขาอำเภอดอยสะเก็ด');
        define('ACCOUNT_NO', '983-4-94181-1');
        define('PEA_PHONE', 'โทร 053-104-842');
        define('PEA_METER_PHONE', '053-104-840 ต่อ 14814');
        define('PEA_EXTRA_PHONE', '053-104-842');
        break;
    default:
        define('DB_DATABASE', 'chai-van_pea');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาคจังหวัดเชียงใหม่ 2');
        define('DIR_NAME', 'PEACHM02');
        define('DIR_UPLOAD', '/var/www/pea-meter.com/public_html/upload/PEACHM02/');
        define('LINE_TOKEN', 'M6YvaNRBndeOGqZv1OOOMrB6UTW1fXVLdis38WAggRA');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค จังหวัดเชียงใหม่ 2');
        define('ACCOUNT_NO', '547-0-45597-1');
        define('PEA_PHONE', 'โทร 053-896020');
        define('PEA_METER_PHONE', '053-896125');
        define('PEA_EXTRA_PHONE', '053-896020');
}

define('DIR_ROOT', '/var/www/pea-meter.com/public_html/meter/');
//define('DIR_ROOT', '/Users/devilpooh/www/pea-meter.test.com/public/meter/');
define('ENABLE_SLIPT_UPLOAD', 1);

$thai_month = array(
    'มกราคม',
    'กุมภาพันธ์',
    'มีนาคม',
    'เมษายน',
    'พฤษภาคม',
    'มิถุนายน',
    'กรกฎาคม',
    'สิงหาคม',
    'กันยายน',
    'ตุลาคม',
    'พฤษจิกายน',
    'ธันวาคม'
);

if (!function_exists('dd')) {
    function dd()
    {
        echo '<style>
pre {
    background-color: black;
    color: white;
}
</style>';
        foreach (func_get_args() as $x) {
            echo '<pre>';
            print_r($x);
            echo '</pre>';
        }
        die;
    }
}

function date_thai_format($strDate): string
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));

    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

function numtothaistring($num)
{
    $return_str = "";
    $txtnum1 = array('', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า');
    $txtnum2 = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
    $num_arr = str_split($num);
    $count = count($num_arr);
    foreach ($num_arr as $key => $val) {
        if ($count > 1 && $val === 1 && $key === ($count - 1)) {
            $return_str .= "เอ็ด";
        } else {
            $return_str .= $txtnum1[$val] . $txtnum2[$count - $key - 1];
        }
    }
    return $return_str;
}

function numtothai($num)
{
    if ($num === 0) {
        return "ศูนย์บาทถ้วน";
    }
    $return = "";
    $num = str_replace(",", "", $num);
    $number = explode(".", $num);
    if (count($number) > 2) {
        return 'รูปแบบข้อมุลไม่ถูกต้อง';
    }
    $return .= numtothaistring($number[0]) . "บาท";
    $stang = $number[1] ?? 0;
    $stang = (int)$stang;
    if ($stang > 0) {
        $return .= numtothaistring($stang) . "สตางค์";
    } else {
        $return .= "ถ้วน";
    }
    return $return;
}

session_start();
@require('class/database.php');

