<?php

require_once "BaseController.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Vod.php";

class DirectorController extends BaseController {

    public function index($directorId) {
        if ($directorId == null) {
            header("Location: /1PHPD");
            return;
        }

        $director = $this->getModel("vod")->getDirectorFilms($directorId);
        $directorName = $director[0]["first_name"] . " " . $director[0]["last_name"];
        $this->renderView("DirectorsView", ["title" => $directorName, "director" => $director]);
    }
}

