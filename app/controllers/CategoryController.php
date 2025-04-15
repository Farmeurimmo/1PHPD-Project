<?php
require_once "BaseController.php";
require_once __DIR__ . "/../models/Vod.php";

class CategoryController extends BaseController {
    private $vodModel;

    public function __construct() {
        $this->vodModel = new Vod();
    }

    public function crime() {
        $category = "Crime";

        $this->commonPart($category);
    }

    function commonPart($category) {
        $search = $_GET["search"] ?? null;
        $page = $_GET["page"] ?? 1;
        $director = $_GET["director"] ?? null;

        $vods = $this->vodModel->getVods($page, $category, $search, $director);

        $categories = $this->vodModel->getCategories();
        $directors = $this->vodModel->getDirectors();

        $this->renderView("CategoryView", ["title" => "Category: " . $category, "vods" => $vods, "category" => $category, "categories" => $categories, "directors" => $directors]);
    }

    public function drama() {
        $category = "Drama";

        $this->commonPart($category);
    }
}