<?php


namespace FCMS;


final class SessionManager
{
    private static $instance;

    private function __construct() {
        if (!isset($_SESSION['store'])) {
            $_SESSION['store'] = [];
        }
    }

    public static function instance(): SessionManager {
        return self::$instance ?? (self::$instance = new SessionManager());
    }

    public function get(string $key) {
        return $_SESSION['store']["str_$key"] ?? null;
    }

    public function set(string $key, string $val) {
        $_SESSION['store']["str_$key"] = $val;
    }

    public function getUser(): ?User {
        return $_SESSION['store']["obj_user"] ?? null;
    }

    public function setUser(User $user) {
        $_SESSION['store']["obj_user"] = $user;
    }
}