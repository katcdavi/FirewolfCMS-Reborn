<?php


namespace FCMS;


final class StatusCode
{
    /** @var int $code */
    private $code;
    /** @var string $message */
    private $message;

    private function __construct(int $code, string $message) {
        $this->code = $code;
        $this->message = $message;
    }

    public function getCode(): int {
        return $this->code;
    }

    public function getMessage(): string {
        return $this->message;
    }

    public static function ok(): StatusCode {
        return new StatusCode(200, "OK");
    }

    public static function notFound(): StatusCode {
        return new StatusCode(404, "NOT_FOUND");
    }

    public static function fail(): StatusCode {
        return new StatusCode(400, "ERROR");
    }
}