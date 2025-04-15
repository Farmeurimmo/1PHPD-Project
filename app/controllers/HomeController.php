<?php
require_once "BaseController.php";
require_once __DIR__ . "/../models/Vod.php";

class HomeController extends BaseController {
    private $vodModel;

    public function __construct() {
        $this->vodModel = new Vod();
    }

    public function index() {
        $search = $_GET["search"] ?? "";
        $category = $_GET["category"] ?? "";
        $page = $_GET["page"] ?? 1;
        $director = $_GET["director"] ?? "";

        $vods = $this->vodModel->getVods($page, $category, $search, $director);

        $categories = $this->vodModel->getCategories();
        $directors = $this->vodModel->getDirectors();

        $this->renderView("HomeView", ["title" => "Home", "vods" => $vods, "categories" => $categories, "directors" => $directors]);
    }
}
