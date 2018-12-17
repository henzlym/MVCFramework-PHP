<?php

// DATABASE CREDINTALS
define('DB_HOST', '__YOUR_HOST_NAME__');
define('DB_NAME', '__YOUR_DATABASE_NAME__');
define('DB_USER', '__YOUR_USERNAME__');
define('DB_PASS', '__YOUR_PASSWROD__');

// URL
define('APP_PATH', dirname(__FILE__, 2));
define('BASE_URL', BASE_URL());
define('SITE_NAME', '__SITE_TITLE__');


function BASE_URL()
{
    if (isset($_SERVER['HTTPS'])) {
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    } else {
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'];
}
