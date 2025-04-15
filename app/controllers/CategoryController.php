<?php
require_once "BaseController.php";
require_once __DIR__ . "/../models/Vod.php";

class CategoryController extends BaseController {

    function index($category = null) {
        if ($category == null) {
            header("Location: /1PHPD");
            return;
        }

        $search = $_GET["search"] ?? "";
        $page = $_GET["page"] ?? 1;
        $director = $_GET["director"] ?? "";
        if (isset($_GET["category"])) {
            $category = $_GET["category"];
        }

        $category = ucfirst(strtolower($category));

        $vods = $this->getModel("vod")->getVods($page, $category, $search, $director);

        $categories = $this->getModel("vod")->getCategories();
        $directors = $this->getModel("vod")->getDirectors();

        if (!empty($categories)) {
            $categories = array_filter($categories, function ($cat) use ($category) {
                return strtolower($cat["name"]) !== strtolower($category);
            });
        }

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