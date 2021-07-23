<?php


namespace FCMS;


final class Translator
{
    private string $lang;
    private Config $config;

    public function __construct(Config $config, string $lang = null)
    {
        if ($lang === null) {
            $lang = $config->get('defaultLang');
        }

        $this->lang = (string) $lang;
        $this->config = $config;
    }
}