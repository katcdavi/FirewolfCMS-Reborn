<?php

namespace FCMS;


final class Config
{
    private $path;
    private $dict;

    private Set $accessedKeys;
    private OneTimeLog $accessedKeysLog;

    public function __construct(string $path = 'config.inc.txt')
    {
        $this->path = $path;
        $this->dict = [];
        $this->accessedKeys = new Set();
        $this->accessedKeysLog = new OneTimeLog('logs/accessed_config_keys.log');
        $this->init();
    }

    public function get(string $key)
    {
        $key = strtolower($key);
        $this->processAccess("[GNRL]", $key);
        return $this->dict[$key] ?? null;
    }

    public function getBool(string $key): bool
    {
        $key = strtolower($key);
        $this->processAccess("[BOOL]", $key);
        return isset($this->dict[$key]) && ($this->dict[$key] === 'True' || $this->dict[$key] === 'true');
    }

    public function isSet(string $key): bool
    {
        $key = strtolower($key);
        $this->processAccess("[SET?]", $key);
        return isset($this->dict[$key]);
    }

    private function init()
    {
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

            $dict[strtolower(trim($data[0]))] = trim($data[1]);
        }

        $this->dict = $dict;
    }

    private function processAccess(string $prefix, string $key)
    {
        $fullKey = $prefix . $key;
        if (!$this->accessedKeys->isSet($fullKey)) {
            $this->accessedKeys->insert($fullKey);
            $this->accessedKeysLog->log($fullKey);
        }
    }
}