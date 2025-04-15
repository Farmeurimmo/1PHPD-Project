<?php
require_once "BaseController.php";
require_once __DIR__ . "/../models/Vod.php";

class HomeController extends BaseController {
    private $vodModel;

    public function __construct() {
        $this->vodModel = new Vod();
    }

    public function index() {
        $search = $_GET["search"] ?? null;
        $category = $_GET["category"] ?? null;
        $page = $_GET["page"] ?? 1;
        $director = $_GET["director"] ?? null;

        $vods = $this->vodModel->getVods($page, $category, $search, $director);

        $this->renderView("HomeView", ["title" => "Home", "vods" => $vods]);
    }
}
