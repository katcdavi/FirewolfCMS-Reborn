<?php

    namespace FCMS;

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
    $session = SessionManager::instance();

    # translator init
    $tr = new Translator($conf);

    # url args
    $urlArgs = new UrlArgs($conf);

    # fcms controller init
    if (!Controller::setup()) {
        die("[!!!] Controller setup fail!");
    }
    $fcms = new FCMSController($conf, $tr, $session);

    # fcms controller process & render
    $fcms->init($urlArgs);
    $fcms->render();

    # config test
    if ($conf->getBool('printClientIp')) {
        echo "Client: " . $_SERVER['REMOTE_ADDR'];
    }