<?php
require_once "BaseController.php";
require_once __DIR__ . "/../models/Vod.php";

class CartController extends BaseController {
    function add() {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            header('Location: /1PHPD');
            exit(401);
        }

        if (!isset($_SESSION["username"])) {
            header('Location: /1PHPD/auth/login');
            exit(401);
        }

        $cart = isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"], true) : [];

        $product_id = $_POST["vod_id"];

        if (!isset($cart[$product_id])) {
            $cart[$product_id] = 1;

            setcookie("cart", json_encode($cart), time() + (86400 * 30), "/1PHPD");
        }
    }
}