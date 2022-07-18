<?php

define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'chai-van-pea');
define('DB_PASSWORD', 'u3a2epe7a');


switch ($_SERVER['SERVER_NAME']) {
    case 'pea-meter.com':
    case 'peachm02.pea-meter.com':
        define('DB_DATABASE', 'chai-van_pea');
        break;
    case 'peachm01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peachm01');
        break;
    case 'peahad16.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peahad16');
        break;
    case 'peapas23.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peapas23');
        break;
    case 'peadst01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peadst01');
        break;
    case 'peanjd23.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peanjd23');
        break;
    case 'peangao37.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peangao37');
        break;
    case 'peakok131.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peakok131');
        break;
}

session_start();
@require_once('class/database.php');
