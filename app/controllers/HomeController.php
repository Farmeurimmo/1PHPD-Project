<?php
require_once "BaseController.php";
require_once __DIR__ . "/../models/Vod.php";

class HomeController extends BaseController {
    private $vodModel;

    public function __construct() {
        $this->vodModel = new Vod();
    }

    public function index() {
        $search = htmlspecialchars($_GET["search"] ?? null);
        $category = htmlspecialchars($_GET["category"] ?? null);
        $page = htmlspecialchars($_GET["page"] ?? 1);
        $director = htmlspecialchars($_GET["director"] ?? null);

        $vods = $this->vodModel->getVods($page, $category, $search, $director);

        $this->renderView("HomeView", ["title" => "Home", "vods" => $vods]);
    }
}
