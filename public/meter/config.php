<?php

define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'chai-van-pea');
define('DB_PASSWORD', 'u3a2epe7a');

define('DIR_ROOT', '/var/www/pea-meter.com/public_html/meter/');
//define('DIR_ROOT', '/Users/devilpooh/www/pea-meter.test.com/public/meter/');
define('ENABLE_SLIPT_UPLOAD', 1);
define('LINE_NOTIFICATION', 1);

$REPORT_P3_LAST_ACCEPT_DATE = 'ผบห/ผบค รับงาน';

switch ($_SERVER['SERVER_NAME']) {
    case 'pea-meter.com':
    case 'peachm02.pea-meter.com':
        define('DB_DATABASE', 'chai-van_pea');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาคจังหวัดเชียงใหม่ 2');
        define('DIR_NAME', 'PEACHM02');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEACHM02/');
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
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEACHM01/');
        define('LINE_TOKEN', 'tUNZYHJBuJlUfPWzKda0GiKM5HVyCajsPzoiMHrIVEI');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค จังหวัดเชียงใหม่');
        define('ACCOUNT_NO', '501-1-13664-7');
        define('PEA_PHONE', 'โทร 053-266-422 , 053-241-266');
        define('PEA_METER_PHONE', '053-243064');
        define('PEA_EXTRA_PHONE', '053-241266');
        break;
    case 'peachm01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peachm01');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาคจังหวัดเชียงใหม่ 1');
        define('DIR_NAME', 'PEACHM01');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEACHM01/');
        define('LINE_TOKEN', 'OYPBGplJKLsBWUzAxLnXxwc9fL5WIHjRy6CUBEu31iU');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค จังหวัดเชียงใหม่ สาขาท่าแพ');
        define('ACCOUNT_NO', '501-1-13664-7');
        define('PEA_PHONE', 'โทร 053 241266');
        define('PEA_METER_PHONE', '053 243064');
        define('PEA_EXTRA_PHONE', '053 241266');
        break;
    case 'peakok131.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peakok131');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาคอำเภอเกาะคา จังหวัดลำปาง');
        define('DIR_NAME', 'PEAKOK131');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEAKOK131/');
        define('LINE_TOKEN', 'bMU2RlQlLwmbpr3lyJ2H2tG0YGIDMogoLtr4nhsPPcF');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาคอำเภอเกาะคา จังหวัดลำปาง');
        define('ACCOUNT_NO', '552-0-22593-1');
        define('PEA_PHONE', 'โทร 054-284807');
        define('PEA_METER_PHONE', '054-284838');
        define('PEA_EXTRA_PHONE', '054-284807');
        break;
    case 'peahad16.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peahad16');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาค อำเภอหางดง จังหวัดเชียงใหม่');
        define('DIR_NAME', 'PEAHAD16');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEAHAD16/');
        define('LINE_TOKEN', 'vP9b4mn2kB43qFXwZtDhqgjzYVUwI2UigddmTFQFZyi');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค อำเภอหางดง');
        define('ACCOUNT_NO', '538-1-11485-0');
        define('PEA_PHONE', 'โทร 0-5344-1776');
        define('PEA_METER_PHONE', '0-5310-6703');
        define('PEA_EXTRA_PHONE', '0-5344-1776');
//        $REPORT_P3_LAST_ACCEPT_DATE =  'ผบค รับงาน';
        break;
    case 'peapas23.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peapas23');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาค อำเภอป่าซาง จังหวัดลำพูน');
        define('DIR_NAME', 'PEAPAS23');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEAPAS23/');
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
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEADST01/');
        define('LINE_TOKEN', 'jv8IRjAkypZot2FdHbHxWT5PdwCaBDycqZ8Vs4kLu4Z');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค สาขาอำเภอดอยสะเก็ด');
        define('ACCOUNT_NO', '983-4-94181-1');
        define('PEA_PHONE', 'โทร 053-104-842');
        define('PEA_METER_PHONE', '053-104-840 ต่อ 14814');
        define('PEA_EXTRA_PHONE', '053-104-842');
        break;
    case 'peanjd23.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peanjd23');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาค สาขาย่อยตำบลนครเจดีย์ อำเภอป่าซาง จังหวัดลำพูน');
        define('DIR_NAME', 'PEANJD23');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEANJD23/');
        define('LINE_TOKEN', 'ZVVfbrCI4CLfpOdD8tp0ONL0h4fpJkqgkPQFl90aE1I');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค อำเภอป่าซาง');
        define('ACCOUNT_NO', '798-0-01616-5');
        define('PEA_PHONE', 'โทร 053-555-381');
        define('PEA_METER_PHONE', '053-555-381');
        define('PEA_EXTRA_PHONE', '053-555-381');
        break;
    case 'peakok131.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peakok131');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาค อำเภอเกาะคา จังหวัดลำปาง');
        define('DIR_NAME', 'PEAKOK131');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEAKOK131/');
        define('LINE_TOKEN', 'C55z757SMjwW0S4eqknQ5ogiCpvDGDEyVFheVXWg3kN');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค อำเภอเกาะคา');
        define('ACCOUNT_NO', '552-0-22593-1');
        define('PEA_PHONE', 'โทร 054-284-807, 064-270-5920');
        define('PEA_METER_PHONE', '054-284-838');
        define('PEA_EXTRA_PHONE', '054-284-807');
        break;
    case 'peasaso01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peasaso01');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาค อำเภอสันทราย จังหวัดเชียงใหม่');
        define('DIR_NAME', 'PEASASO01');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEASASO01/');
        define('LINE_TOKEN', 'TUREBSGRR85oliScU8M5IyFaDaeikg3B6o2wMFQpLAJ');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค อำเภอสันทราย');
        define('ACCOUNT_NO', '375-1-03390-4');
        define('PEA_PHONE', 'โทร 053-492001');
        define('PEA_METER_PHONE', '053-491-623');
        define('PEA_EXTRA_PHONE', '053-492-001');
        break;
    case 'pealpn01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_pealpn01');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาค จังหวัดลำพูน');
        define('DIR_NAME', 'PEALPN01');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEALPN01/');
        define('LINE_TOKEN', 't8J0SJUTDz0DSon9DvECZWk2fPH6kwiKUeVHn3rKER0');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค จังหวัดลำพูน');
        define('ACCOUNT_NO', '511-1-20373-7');
        define('PEA_PHONE', 'โทร 053-560-111, 082-182-2588');
        define('PEA_METER_PHONE', '053-561-443');
        define('PEA_EXTRA_PHONE', '053-560-111');
        break;
    case 'peahac01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peahac01');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาค สาขาอำเภอห้างฉัตร');
        define('DIR_NAME', 'PEAHAC01');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEAHAC01/');
        define('LINE_TOKEN', 'ROWBLtXER1S0c3OGzysrYqQD5OIKTIOk0FflbR3yUPg');
        define('BANK_NAME', 'ธนาคารออมสิน');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค สาขาอำเภอห้างฉัตร');
        define('ACCOUNT_NO', '020391723879');
        define('PEA_PHONE', 'โทร 054-339080');
        define('PEA_METER_PHONE', '054-339080');
        define('PEA_EXTRA_PHONE', '054-268721');
        break;
    case 'peapan01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peapan01');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาคอำเภอพาน จังหวัดเชียงราย');
        define('DIR_NAME', 'PEAPAN01');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEAPAN01/');
        define('LINE_TOKEN', 'GkvwN44aaDWtbCUckY4CFeaAK5JnuVcav6ZFaJKn4KV');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค อำเภอพาน');
        define('ACCOUNT_NO', '522-1-03470-0');
        define('PEA_PHONE', 'โทร 053-723043');
        define('PEA_METER_PHONE', '053-721514');
        define('PEA_EXTRA_PHONE', '053-723043');
        define('EXPIRES', 1);
        break;
    case 'peamas01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peamas01');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาคอำเภอแม่สาย จังหวัดเชียงราย');
        define('DIR_NAME', 'PEAMAS01');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEAMAS01/');
        define('LINE_TOKEN', '37JVo1zbVS2ydLDtGoDiwch7o8vzjDLFEAcwtIW7isH');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาคอำเภอแม่สาย');
        define('ACCOUNT_NO', '505-1-08817-1');
        define('PEA_PHONE', 'โทร 053-642507');
        define('PEA_METER_PHONE', '053-731714');
        define('PEA_EXTRA_PHONE', '053-642507');
        break;
    case 'peadkt01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peadkt01');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาคอำเภอดอกคำใต้ จังหวัดพะเยา');
        define('DIR_NAME', 'PEADKT01');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEADKT01/');
        define('LINE_TOKEN', 'DrD55dompSJk6cNoHFVPHPWjZb766zfGCfSc999RV17');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาคสาขาอำเภอดอกคำใต้');
        define('ACCOUNT_NO', '541-0-23271-2');
        define('PEA_PHONE', 'โทร 054-491008');
        define('PEA_METER_PHONE', '054-491008');
        define('PEA_EXTRA_PHONE', '054-491008');
        define('EXPIRES', 1);
        break;
    case 'peawpp01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peawpp01');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาคอำเภอเวียงป่าเป้า จังหวัดเชียงราย');
        define('DIR_NAME', 'PEAWPP01');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEAWPP01/');
        define('LINE_TOKEN', '8LzFfTQudZe7mYIZN1GXy5icm0NcBuTXioVtxhGZJzc');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาคสาขาอำเภอเวียงป่าเป้า');
        define('ACCOUNT_NO', '980-6-57605-5');
        define('PEA_PHONE', 'โทร 053-952028');
        define('PEA_METER_PHONE', '053-952354');
        define('PEA_EXTRA_PHONE', '053-952028');
        define('EXPIRES', 1);
        break;
    case 'pealpg01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_pealpg01');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาคสาขาเมืองลำปาง');
        define('DIR_NAME', 'PEALPG01');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEALPG01/');
        define('LINE_TOKEN', 'IfiO2SxXkZELQaEoS5aeecdtDvHeiuaO3uvPsneKp2k');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาคจังหวัดลำปาง');
        define('ACCOUNT_NO', '552-1-00600-1');
        define('PEA_PHONE', 'โทร 054-250009');
        define('PEA_METER_PHONE', '054-250444');
        define('PEA_EXTRA_PHONE', '054-250009');
        break;
    default:
        define('DB_DATABASE', 'chai-van_pea');
        define('PEANAME', 'การไฟฟ้าส่วนภูมิภาคจังหวัดเชียงใหม่ 2');
        define('DIR_NAME', 'PEACHM02');
        define('DIR_UPLOAD', DIR_ROOT . '../upload/PEACHM02/');
        define('LINE_TOKEN', 'M6YvaNRBndeOGqZv1OOOMrB6UTW1fXVLdis38WAggRA');
        define('BANK_NAME', 'ธนาคารกรุงไทย');
        define('ACCOUNT_NAME', 'การไฟฟ้าส่วนภูมิภาค จังหวัดเชียงใหม่ 2');
        define('ACCOUNT_NO', '547-0-45597-1');
        define('PEA_PHONE', 'โทร 053-896020');
        define('PEA_METER_PHONE', '053-896125');
        define('PEA_EXTRA_PHONE', '053-896020');
}

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

