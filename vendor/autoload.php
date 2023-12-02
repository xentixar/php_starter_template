<?php
include_once __DIR__ . '/../config/environment.php';
include_once __DIR__ . '/../config/app.php';

spl_autoload_register(function ($class_name) {
    include __DIR__ . "/../config/" . $class_name . '.php';
});
