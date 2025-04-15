<?php
require_once "BaseController.php";
require_once __DIR__ . "/../models/Vod.php";

class CategoryController extends BaseController {

    function index($category = null) {
        if ($category == null) {
            header("Location: /1PHPD");
            return;
        }

        $category = ucfirst(strtolower($category));

        $search = $_GET["search"] ?? "";
        $page = $_GET["page"] ?? 1;
        $director = $_GET["director"] ?? "";

        $vods = $this->getModel("vod")->getVods($page, $category, $search, $director);

        $categories = $this->getModel("vod")->getCategories();
        $directors = $this->getModel("vod")->getDirectors();

        $this->renderView("CategoryView", [
            "title" => "Category: " . $category,
            "vods" => $vods,
            "category" => $category,
            "categories" => $categories,
            "directors" => $directors,
            "description" => "Browse the best " . $category . " movies available on our platform.",
            "keywords" => $category . ", movies, video on demand, directors, categories"
        ]);
    }
}