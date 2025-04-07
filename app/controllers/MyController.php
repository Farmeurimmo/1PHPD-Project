<?php

require_once "BaseController.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Vod.php";

class MyController extends BaseController {
    private $userModel;
    private $vodModel;

    public function __construct() {
        $this->userModel = new User();
        $this->vodModel = new Vod();
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

    function myCart() {
        if (!$this->userModel->isLoggedIn()) {
            header("Location: /1PHPD/auth/");
            exit(403);
        }

        $cart = isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"], true) : [];

        $vods = [];
        foreach ($cart as $vodId => $quantity) {
            try {
                $vod = $this->vodModel->getVodData($vodId);
                if ($vod) {
                    $vods[] = $vod;
                }
            } catch (Exception $e) {
            }
        }


        $this->renderView("MyCartView", ["title" => "My Cart", "cart" => $vods]);
    }

    function myCartCheckout() {
        if (!$this->userModel->isLoggedIn()) {
            header("Location: /1PHPD/auth/");
            exit(403);
        }

        $cart = isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"], true) : [];

        if (empty($cart)) {
            header("Location: /1PHPD/my/cart");
            exit(400);
        }

        $userId = $_SESSION["userId"];
        $this->userModel->checkoutCart($userId, $cart);

        setcookie("cart", json_encode([]), time() - 3600, "/1PHPD");

        header("Location: /1PHPD/my/cart");
        exit(200);
    }
}