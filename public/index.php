<?php

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

$router->dispatch($_SERVER['REQUEST_URI']);