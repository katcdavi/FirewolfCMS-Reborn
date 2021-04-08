<?php


final class UrlArgs
{
    /** @var string $url */
    private $url;
    /** @var array $dict */
    private $dict;
    /** @var Config $conf */
    private $conf;

    public function __construct(Config $conf, string $url = null)
    {
        $this->url = $url ?? $_SERVER['REQUEST_URI'];
        $this->conf = $conf;

        if ($this->conf->isSet('subdir')) {
            $this->url = str_replace($this->conf->get('subdir'), '', $this->url);
        }

        var_dump($this->url);
        echo "<br><br>";
        $this->dict = explode("/", $this->url);

        $this->dict = array_filter($this->dict, function ($e) {
            return !empty($e);
        });
        echo "<br><br>";
        var_dump($this->dict);
        echo "<br><br>";
    }
}