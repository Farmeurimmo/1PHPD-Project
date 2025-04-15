<?php
require_once "BaseController.php";
require_once __DIR__ . "/../models/Vod.php";

class CategoryController extends BaseController {

    public function action() {
        $category = "Action";

        $this->commonPart($category);
    }

    function commonPart($category) {
        $search = $_GET["search"] ?? "";
        $page = $_GET["page"] ?? 1;
        $director = $_GET["director"] ?? "";

        $vods = $this->getModel("vod")->getVods($page, $category, $search, $director);

        $categories = $this->getModel("vod")->getCategories();
        $directors = $this->getModel("vod")->getDirectors();

        $this->renderView("CategoryView", ["title" => "Category: " . $category, "vods" => $vods, "category" => $category, "categories" => $categories, "directors" => $directors]);
    }

    public function drama() {
        $category = "Drama";

        $this->commonPart($category);
    }
}