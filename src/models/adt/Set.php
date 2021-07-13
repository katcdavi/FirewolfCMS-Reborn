<?php


namespace FCMS;


final class Set
{
    private array $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function insert(string $val)
    {
        if (!$this->isSet($val)) {
            $this->data[] = $val;
        }
    }

    public function isSet(string $val): bool
    {
        return in_array($val ,$this->data);
    }
}