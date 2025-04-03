<?php

require_once "BaseController.php";
require_once __DIR__ . "/../models/User.php";

class UserAuthController extends BaseController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function index() {
        if ($this->userModel->isLoggedIn()) {
            header("Location: /1PHPD/");
            exit(200);
        }

        $this->renderView("UserAuthView", ["title" => "Sign In or Sign Up"]);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header("Location: /1PHPD/auth/");
            exit(400);
        }

        $email = htmlspecialchars($_POST["email"]);
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);

        if (empty($email) || empty($username) || empty($password)) {
            $_SESSION ["errorMessage"] = "All fields are required.";

            header("Location: /1PHPD/auth/");
            exit(400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 128 || strlen($email) < 5) {
            $_SESSION["errorMessage"] = "Invalid email address";

            header("Location: /1PHPD/auth/");
            exit(400);
        }

        if (strlen($username) < 3 || strlen($username) > 24) {
            $_SESSION ["errorMessage"] = "Username must be at least 3 characters long and at most 24 characters long.";

            header("Location: /1PHPD/auth/");
            exit(400);
        }

        if (strlen($password) < 8 || strlen($password) > 48) {
            $_SESSION["errorMessage"] = "Password must be at least 8 characters long and at most 48 characters long.";

            header("Location: /1PHPD/auth/");
            exit(400);
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $this->userModel->register($email, $username, $password);

            header("Location: /1PHPD/");
        } catch (Exception $e) {
            if ($e->getCode() == 23000) {
                $_SESSION["errorMessage"] = "Email or username already exists.";
            } else {
                $_SESSION["errorMessage"] = "An error occurred while registering. Please try again later.";
            }

            header("Location: /1PHPD/auth/");
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header("Location: /1PHPD/auth/");
            exit(400);
        }

        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        if (empty($email) || empty($password)) {
            $_SESSION["errorMessage"] = "All fields are required.";
            header("Location: /1PHPD/auth/");
            exit(400);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 128 || strlen($email) < 5) {
            $_SESSION["errorMessage"] = "Invalid email address";
            header("Location: /1PHPD/auth/");
            exit(400);
        }

        if (strlen($password) < 8 || strlen($password) > 48) {
            $_SESSION["errorMessage"] = "Password must be at least 8 characters long and at most 48 characters long.";
            header("Location: /1PHPD/auth/");
            exit(400);
        }

        try {
            $this->userModel->login($email, $password);

            header("Location: /1PHPD/");
        } catch (Exception $e) {
            $_SESSION["errorMessage"] = $e->getMessage();
            header("Location: /1PHPD/auth/");
        }
    }

    public function logout() {
        if ($this->userModel->isLoggedIn()) {
            $this->userModel->logout();
        }
        header("Location: /1PHPD/auth/");
    }
}