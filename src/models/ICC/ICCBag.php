<?php


namespace FCMS;


// ICC - Inter Class Communication
abstract class ICCBag
{
    private static ?Config $Config = null;

    public static function setConf(Config $config)
    {
        self::$Config = $config;
    }

    public static function conf(): Config
    {
        return self::$Config;
    }

    private static ?Translator $Translator = null;

    public static function setTr(Translator $translator)
    {
        self::$Translator = $translator;
    }

    public static function tr(): Translator
    {
        return self::$Translator;
    }
}