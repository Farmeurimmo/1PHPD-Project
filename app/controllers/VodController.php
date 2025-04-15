<?php

require_once "BaseController.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Vod.php";

class VodController extends BaseController {
    private $userModel;
    private $vodModel;

    public function __construct() {
        $this->userModel = new User();
        $this->vodModel = new Vod();
    }

    public function index($vodId = null) {
        if ($vodId == null) {
            header("Location: /1PHPD");
            return;
        }

        $vod = $this->vodModel->getVodData($vodId);

        $this->renderView("VodView", ["title" => $vod["title"], "vod" => $vod]);
    }
}