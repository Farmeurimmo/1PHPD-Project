<?php
require_once "BaseController.php";

class HomeController extends BaseController {
    public function index() {
        $this->renderView("HomeView", ["title" => "Home"]);
    }
}
