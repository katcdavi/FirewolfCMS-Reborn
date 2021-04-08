<?php

    # session
    mb_internal_encoding("UTF-8");
    session_start();

    # autoloader
    require_once "./src/main/autoloader.php";
    $autoloaderName = 'fcms_autoloader';
    if (!function_exists($autoloaderName) || !spl_autoload_register($autoloaderName)) {
        die("[!!!] Autoload registration fail!");
    }

    # config init
    $conf = new Config();

    # session manager init

    # translator init

    # url args
    $urlArgs = new UrlArgs($conf);

    # fcms controller init

    # fcms controller process & render

    # config test
    if ($conf->getBool('printClientIp')) {
        echo "Client: " . $_SERVER['REMOTE_ADDR'];
    }