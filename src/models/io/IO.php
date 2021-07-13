<?php


namespace FCMS;


final class IO
{
    public static function createFile(string $path, bool $deleteIfExists = false)
    {
        if (!file_exists($path) || $deleteIfExists) {
            file_put_contents($path, "");
        }
    }

    public static function append(string $path, string $data)
    {
        file_put_contents($path, $data, FILE_APPEND);
    }

    public static function appendMultiple(string $path, array $data)
    {
        file_put_contents($path, $data, FILE_APPEND);
    }
}