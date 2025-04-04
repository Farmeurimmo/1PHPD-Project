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
        $vods = $this->vodModel->getVods(1, $category);

        if (empty($vods)) {
            header("Location: /1PHPD/");
            exit(404);
        }

        $this->renderView("CategoryView", ["title" => "Category: " . $category, "vods" => $vods, "category" => $category]);
    }

    public function drama() {
        $category = "Drama";

        $this->commonPart($category);
    }
}