<?php

// For timezone
if (getenv('APP_TIMEZONE')) {
    date_default_timezone_set(getenv('APP_TIMEZONE'));
} else {
    date_default_timezone_set('UTC');
}

// For assets
function asset(string $path = '')
{

    if (
        isset($_SERVER['HTTPS']) &&
        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
    ) {
        $protocol = 'https://';
    } else {
        $protocol = 'http://';
    }
    return $protocol . $_SERVER['SERVER_NAME'] . (getenv('APP_URI') ? '/' : '') . (getenv('APP_URI') ?? '') . "/public/$path";
}
