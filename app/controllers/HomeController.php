<?php
require_once "BaseController.php";
require_once __DIR__ . "/../models/Vod.php";

class HomeController extends BaseController {
    private $vodModel;

    public function __construct() {
        $this->vodModel = new Vod();
    }

    public function index() {
        $vods = $this->vodModel->getVods();

        $this->renderView("HomeView", ["title" => "Home", "vods" => $vods]);
    }
}
