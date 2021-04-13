<?php


namespace FCMS;


abstract class Controller
{
    /** @var array $keywords */
    private $keywords = [];
    /** @var string $view */
    private $view = '';
    /** @var string $title */
    private $title = '';
    /** @var array $data */
    private $data = [];

    /** @var ControllerInfo|null */
    private $info = null;

    const VIEW_LOCATION_INFO = [
        'path' => [
            'src', 'views'
        ],
        'suffix' => 'phtml'
    ];

    private static $viewSrc = null;


    public function getKeywords(): array {
        return $this->keywords;
    }

    public function setKeywords(array $keywords) {
        $this->keywords = $keywords;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function getView(): string {
        return $this->view;
    }

    public function setView(string $view) {
        $this->view = $view;
    }

    public function getInfo(): ControllerInfo {
        return $this->info;
    }

    public function setInfo(ControllerInfo $info) {
        $this->info = $info;
    }

    public abstract function init(UrlArgs $args): bool;
    public abstract function process(): StatusCode;

    public function render() {
        extract($this->data);
        require(self::$viewSrc . $this->view . self::VIEW_LOCATION_INFO['suffix']);
    }

    public static function setup(): bool {
        self::$viewSrc = implode(DIRECTORY_SEPARATOR, self::VIEW_LOCATION_INFO['path']);
        return true;
    }
}