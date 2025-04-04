<?php

require_once "BaseController.php";
require_once __DIR__ . "/../models/User.php";

class MyController extends BaseController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    function myFilms() {
        if (!$this->userModel->isLoggedIn()) {
            header("Location: /1PHPD/auth/");
            exit(403);
        }

        $userId = $_SESSION["userId"];
        $films = $this->userModel->getUserFilms($userId);

        $this->renderView("MyFilmsView", ["title" => "My Films", "films" => $films]);
    }

    function myProfile() {
        if (!$this->userModel->isLoggedIn()) {
            header("Location: /1PHPD/auth/");
            exit(403);
        }

        $userId = $_SESSION["userId"];
        try {
            $user = $this->userModel->getUserById($userId);
        } catch (Exception $e) {
            header("Location: /1PHPD/auth/");
            exit(403);
        }

        $this->renderView("MyProfileView", ["title" => "My Profile", "user" => $user]);
    }
}