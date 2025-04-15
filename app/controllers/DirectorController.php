<?php

require_once "BaseController.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Vod.php";

class DirectorController extends BaseController {
    private $userModel;
    private $vodModel;

    public function __construct() {
        $this->userModel = new User();
        $this->vodModel = new Vod();
    }

    public function index($directorId) {
        if ($directorId == null) {
            header("Location: /1PHPD");
            return;
        }

        $director = $this->vodModel->getDirectorFilms($directorId);
        $directorName = $director[0]["first_name"] . " " . $director[0]["last_name"];
        $this->renderView("DirectorsView", ["title" => $directorName, "director" => $director]);
    }
}
?>
