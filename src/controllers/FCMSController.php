<?php


namespace FCMS;


final class FCMSController extends Controller
{
    /** @var Controller|null $controller */
    protected $controller;

    public function __construct(Config $config, Translator $translator, SessionManager $session) {
        parent::__construct($config, $translator, $session);
    }

    public function init(UrlArgs $args): bool {
        $controllerName = $args->getNext();

        if ($controllerName === null) {
            $controllerName = "home";
        }

        $controllerName = $this->getControllerName($controllerName);
        $this->controller = new $controllerName($this->config, $this->translator, $this->session);

        $this->controller->init($args);

        $this->setKeywords($this->controller->getKeywords());
        $this->setTitle($this->controller->getTitle());
        $this->setInfo($this->controller->getInfo());
        $this->setView("main");

        $this->data['session_successMessage'] = $this->session->get(SessionKey::SUCCESS_MESSAGE);
        $this->data['session_infoMessage'] = $this->session->get(SessionKey::INFO_MESSAGE);
        $this->data['session_errorMessage'] = $this->session->get(SessionKey::ERROR_MESSAGE);

        $this->data['controller'] = $this->controller;

        return true;
    }

    public function process(): StatusCode {
        return StatusCode::ok();
    }

    private function getControllerName(string $name): string {
        $name = str_replace("-", " ", $name);
        $name = ucwords($name);
        $name = str_replace(" ", "", $name);
        $name = "FCMS\\{$name}Controller";
        return $name;
    }
}