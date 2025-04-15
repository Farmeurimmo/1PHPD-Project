<?php

require_once "BaseController.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Vod.php";

class VodController extends BaseController {

    public function index($vodId = null) {
        if ($vodId == null) {
            header("Location: /1PHPD");
            return;
        }

        $vod = $this->getModel("vod")->getVodData($vodId);

        $this->renderView("VodView", ["title" => $vod["title"], "vod" => $vod]);
    }
}