<?php

require_once "BaseController.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Vod.php";

class MyController extends BaseController {
    function myFilms() {
        if (!$this->getModel("user")->isLoggedIn()) {
            header("Location: /1PHPD/auth/");
            exit(403);
        }

        $userId = $_SESSION["userId"];
        $films = $this->getModel("user")->getUserFilms($userId);

        $this->renderView("MyFilmsView", ["title" => "My Films", "films" => $films]);
    }

    function myProfile() {
        if (!$this->getModel("user")->isLoggedIn()) {
            header("Location: /1PHPD/auth/");
            exit(403);
        }

        $userId = $_SESSION["userId"];
        try {
            $user = $this->getModel("user")->getUserById($userId);
        } catch (Exception $e) {
            header("Location: /1PHPD/auth/");
            exit(403);
        }

        $this->renderView("MyProfileView", ["title" => "My Profile", "user" => $user]);
    }

    function myCart() {
        if (!$this->getModel("user")->isLoggedIn()) {
            header("Location: /1PHPD/auth/");
            exit(403);
        }

        $cart = isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"], true) : [];

        $vods = [];
        foreach ($cart as $vodId => $quantity) {
            try {
                $vod = $this->getModel("vod")->getVodData($vodId);
                if ($vod) {
                    $vods[] = $vod;
                }
            } catch (Exception $e) {
            }
        }


        $this->renderView("MyCartView", ["title" => "My Cart", "cart" => $vods]);
    }

    function myCartCheckout() {
        if (!$this->getModel("user")->isLoggedIn()) {
            header("Location: /1PHPD/auth/");
            exit(403);
        }

        $cart = isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"], true) : [];

        if (empty($cart)) {
            header("Location: /1PHPD/my/cart");
            exit(400);
        }

        $userId = $_SESSION["userId"];

        try {
            $this->getModel("user")->checkoutCart($userId, $cart);

            setcookie("cart", json_encode([]), time() - 3600, "/1PHPD");
        } catch (Exception $e) {
            $errorIdFilm = $_SESSION["errorFilm"];

            $film_title = $this->getModel("vod")->getFilmTitle($errorIdFilm);

            $_SESSION["errorMessage"] = $e->getMessage() . " (" . $film_title . ")";
        }

        $brought = [];

        foreach ($cart as $vodId => $quantity) {
            try {
                $vod = $this->getModel("vod")->getVodData($vodId);
                if ($vod) {
                    $brought[] = $vod;
                }
            } catch (Exception $e) {
            }
        }

        $totalPrice = 0;
        foreach ($brought as $vod) {
            $totalPrice += $vod["price"];
        }

        $this->renderView("MyCartBroughtView", ["title" => "My Cart brought", "cart" => $brought, "totalPrice" => $totalPrice]);
    }
}