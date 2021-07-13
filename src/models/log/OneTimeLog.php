<?php


namespace FCMS;


final class OneTimeLog
{
    private string $path;
    private array $records;

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->records = [];
        IO::createFile($this->path, true);
    }

    public function log(string $message)
    {
        $this->records[] = $message;
        IO::append($this->path, "$message\n");
    }
}