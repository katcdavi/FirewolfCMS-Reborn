<?php


namespace FCMS;


final class HomeController extends Controller
{
    public function init(UrlArgs $args): bool {
        $this->setKeywords([
            'fcms', 'home', 'main'
        ]);
        $this->setTitle('FCMS HomePage');
        $this->setView("home");
        $this->setInfo(new ControllerInfo('', '', ''));

        $this->data['versionStr'] = "v2.0.0";

        return true;
    }

    public function process(): StatusCode {
        // TODO: Implement process() method.
    }
}