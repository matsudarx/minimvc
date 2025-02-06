<?php

// PHP Library
require_once "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable("config/");
$dotenv->safeLoad();

spl_autoload_register(function ($class) {
    // Models
    if (file_exists("src/models/$class.php")) {
        require_once "src/models/$class.php";
    }
});
