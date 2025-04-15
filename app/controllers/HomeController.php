<?php
require_once "BaseController.php";
require_once __DIR__ . "/../models/Vod.php";

class HomeController extends BaseController {

    public function index() {
        $search = $_GET["search"] ?? "";
        $category = $_GET["category"] ?? "";
        $page = $_GET["page"] ?? 1;
        $director = $_GET["director"] ?? "";

        $vods = $this->getModel("vod")->getVods($page, $category, $search, $director);

        $categories = $this->getModel("vod")->getCategories();
        $directors = $this->getModel("vod")->getDirectors();

        $this->renderView("HomeView", [
            "title" => "Home",
            "vods" => $vods,
            "categories" => $categories,
            "directors" => $directors,
            "description" => "Explore our vast collection of videos on demand, categorized for your convenience.",
            "keywords" => "home, vod, video on demand, movies, directors, categories"
        ]);
    }
}
