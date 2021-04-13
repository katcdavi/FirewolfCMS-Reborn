<?php


namespace FCMS;


final class FCMSController extends Controller
{
    /** @var Controller|null $controller */
    protected $controller;

    public function init(UrlArgs $args): bool {
        $controllerName = $args->getNext();
        $this->controller = new $controllerName;

        $this->controller->init($args);

        $this->setKeywords($this->controller->getKeywords());
        $this->setTitle($this->controller->getTitle());
        $this->setInfo($this->controller->getInfo());
        $this->setView("main");

        return true;
    }

    public function process(): StatusCode {
        return StatusCode::ok();
    }

}