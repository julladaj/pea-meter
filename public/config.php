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
    case 'peasaso01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peasaso01');
        break;
    case 'pealpn01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_pealpn01');
        break;
    case 'peapan01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peapan01');
        break;
    case 'peamas01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peamas01');
        break;
    case 'peadkt01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peadkt01');
        break;
    case 'peawpp01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_peawpp01');
        break;
    case 'pealpg01.pea-meter.com':
        define('DB_DATABASE', 'chai-van_pealpg01');
        break;
    default:
        define('DB_DATABASE', 'chai-van_pea');
}

session_start();
@require_once('class/database.php');
