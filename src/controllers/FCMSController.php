<?php


namespace FCMS;


final class FCMSController extends Controller
{
    public function init(UrlArgs $args): bool {
        return true;
    }

    public function process(): StatusCode {
        return StatusCode::ok();
    }

}