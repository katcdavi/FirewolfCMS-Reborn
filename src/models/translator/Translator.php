<?php


namespace FCMS;


final class Translator
{
    private string $lang;

    public function __construct(string $lang = null)
    {
        $conf = ICCBag::conf();

        if ($lang === null) {
            $lang = $conf->get('defaultLang');
        }

        $this->lang = (string) $lang;
    }
}