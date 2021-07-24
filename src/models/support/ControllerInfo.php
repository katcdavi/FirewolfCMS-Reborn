<?php


namespace FCMS;


final class ControllerInfo
{
    /** @var string $title */
    private $title;
    /** @var string $permission */
    private $permission;
    /** @var string $url */
    private $url;

    public function __construct(string $title, string $permission, string $url) {
        $this->title = $title;
        $this->permission = $permission;
        $this->url = $url;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getPermission(): string {
        return $this->permission;
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function __toString(): string {
        $title = $this->title;
        $permission = $this->permission;
        $url = $this->url;
        return "[ title => '$title', permission => '$permission', url => '$url' ]";
    }
}