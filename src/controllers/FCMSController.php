<?php


namespace FCMS;


final class FCMSController extends Controller
{
    /** @var Controller|null $controller */
    protected $controller;

    public function init(UrlArgs $args): bool {
        $controllerName = $args->getNext();

        if ($controllerName === null) {
            $controllerName = "home";
        }

        $controllerName = $this->getControllerName($controllerName);
        $this->controller = new $controllerName;

        $this->controller->init($args);

        $this->setKeywords($this->controller->getKeywords());
        $this->setTitle($this->controller->getTitle());
        $this->setInfo($this->controller->getInfo());
        $this->setView("main");

        $this->data['controller'] = $this->controller;

        return true;
    }

    public function process(): StatusCode {
        return StatusCode::ok();
    }

    private function getControllerName(string $name): string {
        $name = str_replace("_", " ", $name);
        $name = ucwords($name);
        $name = str_replace(" ", "", $name);
        $name = "FCMS\\{$name}Controller";
        return $name;
    }
}