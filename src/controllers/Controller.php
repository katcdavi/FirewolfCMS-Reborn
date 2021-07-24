<?php


namespace FCMS;


abstract class Controller
{
    /** @var array $keywords */
    protected $keywords = [];
    /** @var string $view */
    protected $view = '';
    /** @var string $title */
    protected $title = '';
    /** @var array $data */
    protected $data = [];

    protected Config $config;
    protected Translator $translator;
    protected SessionManager $session;

    /** @var ControllerInfo|null */
    protected $info = null;

    const VIEW_LOCATION_INFO = [
        'path' => [
            'src', 'views'
        ],
        'suffix' => 'phtml'
    ];

    private static $viewSrc = null;

    public function __construct(Config $config, Translator $translator, SessionManager $session) {
        $this->config = $config;
        $this->translator = $translator;
        $this->session = $session;
    }

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
        # add some more data to be extracted and available in templates
        $this->data['keywordsStr'] = implode(',', $this->getKeywords());
        $this->data['conf'] = $this->config;

        extract($this->data);
        # make available this controller via variable
        $parent = $this;
        require(self::$viewSrc . $this->view . '.' . self::VIEW_LOCATION_INFO['suffix']);
    }

    public static function setup(): bool {
        self::$viewSrc = implode(DIRECTORY_SEPARATOR, self::VIEW_LOCATION_INFO['path']);
        self::$viewSrc .= DIRECTORY_SEPARATOR;
        return true;
    }
}