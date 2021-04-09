<?php

namespace FCMS;


final class UrlArgs
{
    /** @var string $url */
    private $url;
    /** @var array $positional */
    private $positional;
    /** @var array $dict */
    private $dict;
    /** @var Config $conf */
    private $conf;
    /** @var int $pos */
    private $pos = 0;

    public function __construct(Config $conf, string $url = null) {
        $this->url = $url ?? $_SERVER['REQUEST_URI'];
        $this->conf = $conf;
        $this->init();
    }

    public function getNext(): ?string {
        return $this->positional[$this->pos++] ?? null;
    }

    public function getArg(string $key): ?string {
        return $this->dict[$key] ?? null;
    }

    private function init() {
        if ($this->conf->isSet('subdir')) {
            $this->url = str_replace($this->conf->get('subdir'), '', $this->url);
        }

        $exploded = explode("/", $this->url);
        $exploded = array_filter($exploded, function ($e) {
            return !empty($e)|| strlen($e) > 0;
        });
        $exploded = array_values($exploded);

        $this->dict = [];
        if (count($exploded) > 0) {
            $lastItem = $exploded[count($exploded) - 1];

            if (strpos($lastItem, '?') !== FALSE) {
                $paramsStr = substr($lastItem, strpos($lastItem, '?') + 1);
                $exploded[count($exploded) - 1] = str_replace('?'.$paramsStr, '', $lastItem);
                $this->parseParams($paramsStr);
            }
        }

        $this->positional = $exploded;
    }

    private function parseParams(string $paramsStr) {
        $pairs = explode("&", $paramsStr);

        $this->dict = [];
        array_map(function ($pair) {
            $exploded = explode("=", $pair);
            if (count($exploded) !== 2) {
                throw new \Exception("Invalid URL parameters");
            }
            $this->dict[$exploded[0]] = $exploded[1];
        }, $pairs);
    }
}