<?php

namespace FCMS;


final class Config
{
    /** @var string $path */
    private $path;
    /** @var array $dict */
    private $dict;

    public function __construct(string $path = 'config.inc.txt') {
        $this->path = $path;
        $this->dict = [];
        $this->init();
    }

    public function get(string $key) {
        return $this->dict[$key] ?? null;
    }

    public function getBool(string $key): bool {
        return isset($this->dict[$key]) && ($this->dict[$key] === 'True' || $this->dict[$key] === 'true');
    }

    public function isSet(string $key): bool {
        return isset($this->dict[$key]);
    }

    private function init() {
        $content = file_get_contents($this->path);
        $content = explode("\r\n", $content);
        $content = array_filter($content, function ($e) {
            return !empty($e);
        });

        $dict = [];
        foreach ($content as $pair) {
            $data = explode("=", $pair);

            if (count($data) !== 2) {
                throw new \Exception("Syntax error in config file");
            }

            $dict[trim($data[0])] = trim($data[1]);
        }

        $this->dict = $dict;
    }
}