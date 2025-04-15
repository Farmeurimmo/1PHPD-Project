<?php

require_once "BaseController.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Vod.php";

class VodController extends BaseController {

    public function index($vodId = null) {
        if ($vodId == null) {
            header("Location: /1PHPD");
            return;
        }

        $vod = $this->getModel("vod")->getVodData($vodId);

        $this->renderView("VodView", [
            "title" => $vod["title"],
            "vod" => $vod,
            "description" => "Watch " . $vod["title"] . " directed by " . $vod["director_first_name"] . " " . $vod["director_last_name"] . ".",
            "keywords" => $vod["title"] . ", " . $vod["director_first_name"] . " " . $vod["director_last_name"] . ", movies, video on demand"
        ]);
    }
}