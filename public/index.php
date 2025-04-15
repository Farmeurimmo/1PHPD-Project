<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

require_once "../config/Database.php";

try {
    $pdo = Database::getInstance();
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


require_once '../app/core/Autoload.php';
require_once '../app/core/Router.php';

$router = new Router();

$router->addRoute('/', 'HomeController', 'index');

$router->addRoute('/auth/', 'UserAuthController', 'index');
$router->addRoute('/auth/register', 'UserAuthController', 'register');
$router->addRoute('/auth/login', 'UserAuthController', 'login');
$router->addRoute("/auth/logout", 'UserAuthController', 'logout');
$router->addRoute("/auth/password", 'UserAuthController', 'password');

$router->addRoute("/my/profile", 'MyController', 'myProfile');
$router->addRoute("/my/films", 'MyController', 'myFilms');
$router->addRoute("/my/cart", 'MyController', 'myCart');
$router->addRoute("/my/cart/checkout", 'MyController', 'myCartCheckout');

$router->addRoute("/category/action", 'CategoryController', 'action');
$router->addRoute("/category/drama", 'CategoryController', 'drama');

$router->addRoute("/cart/add", 'CartController', 'add');
$router->addRoute("/cart/remove", 'CartController', 'remove');
$router->addRoute("/cart/removeall", 'CartController', 'removeAll');

$router->addRoute("/vod/*", 'VodController', 'index');

$router->addRoute("/director/*", 'DirectorController', 'index');

$parsedUrl = str_replace('/1PHPD', '', $_SERVER['REQUEST_URI']);
$router->dispatch($parsedUrl);