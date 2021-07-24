<?php


namespace FCMS;


final class FormProcessorController extends Controller
{
    public function __construct(Config $config, Translator $translator, SessionManager $session)
    {
        parent::__construct($config, $translator, $session);
    }

    public function init(UrlArgs $args): bool
    {
        $this->setKeywords([
            'fcms', 'form', 'processor'
        ]);
        $this->setTitle('FCMS Form Processor');
        $this->setView("form-processor");
        $this->setInfo(new ControllerInfo('', '', ''));

        return true;
    }

    public function process(): StatusCode
    {
        return StatusCode::ok();
    }

}