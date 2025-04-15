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
        $search = htmlspecialchars($_GET["search"] ?? null);
        $page = htmlspecialchars($_GET["page"] ?? 1);
        $director = htmlspecialchars($_GET["director"] ?? null);

        $vods = $this->vodModel->getVods($page, $category, $search, $director);

        $this->renderView("CategoryView", ["title" => "Category: " . $category, "vods" => $vods, "category" => $category]);
    }

    public function drama() {
        $category = "Drama";

        $this->commonPart($category);
    }
}