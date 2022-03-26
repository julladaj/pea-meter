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
        define('PEA_PHONE', 'โทร 053-441-776 , 053-106-510');
        define('PEA_METER_PHONE', '053-106-703');
        define('PEA_EXTRA_PHONE', '053-106-510');
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
define('ENABLE_SLIPT_UPLOAD', 1);

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

session_start();
@require_once('class/database.php');

