<?php
require_once "BaseController.php";
require_once __DIR__ . "/../models/Vod.php";

class CartController extends BaseController {

    function add() {
        $this->ensurePostAndAuth();

        if (!isset($_POST["vod_id"])) exit(422);

        $product_id = $_POST["vod_id"];
        $cart = $this->loadCart();

        if (!isset($cart[$product_id])) {
            $cart[$product_id] = 1;
            $this->saveCart($cart);
        }
    }

    private function ensurePostAndAuth() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            exit(400);
        }

        if (!isset($_SESSION["username"])) {
            exit(401);
        }
    }

    private function loadCart() {
        return isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"], true) ?? [] : [];
    }

    private function saveCart($cart) {
        setcookie("cart", json_encode($cart), time() + (86400 * 30), "/1PHPD");
    }

    function remove() {
        $this->ensurePostAndAuth();

        if (!isset($_POST["vod_id"])) exit(422);

        $product_id = $_POST["vod_id"];
        $cart = $this->loadCart();

        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            $this->saveCart($cart);
        }
    }
}