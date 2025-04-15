<?php

require_once "BaseController.php";
require_once __DIR__ . "/../models/User.php";

class UserAuthController extends BaseController {
    private $userModel;

    function __construct() {
        $this->userModel = new User();
    }

    function index() {
        if ($this->userModel->isLoggedIn()) {
            header("Location: /1PHPD/");
            exit(200);
        }

        $this->renderView("UserAuthView", ["title" => "Sign In or Sign Up"]);
    }

    function register() {
        $this->ensurePost();

        $email = htmlspecialchars($_POST["email"]);
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);

        if (empty($email) || empty($username) || empty($password)) {
            $this->fail("All fields are required.");
        }

        $this->validateEmail($email);
        $this->validateUsername($username);
        $this->validatePassword($password);

        $password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $this->userModel->register($email, $username, $password);
            header("Location: /1PHPD/");
        } catch (Exception $e) {
            if ($e->getCode() == 23000) {
                $this->fail("Email or username already exists.");
            } else {
                $this->fail("An error occurred while registering. Please try again later.");
            }
        }
    }

    private function ensurePost() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /1PHPD/auth/");
            exit(400);
        }
    }

    private function fail($message, $throwMode = false) {
        $_SESSION["errorMessage"] = $message;
        if ($throwMode) {
            throw new Exception($message);
        }
        header("Location: /1PHPD/auth/");
        exit(400);
    }

    private function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 128 || strlen($email) < 5) {
            $this->fail("Invalid email address");
        }
    }

    private function validateUsername($username) {
        if (strlen($username) < 3 || strlen($username) > 24) {
            $this->fail("Username must be at least 3 characters long and at most 24 characters long.");
        }
    }

    private function validatePassword($password, $throwMode = false) {
        if (strlen($password) < 8 || strlen($password) > 48) {
            $this->fail("Password must be at least 8 characters long and at most 48 characters long.", $throwMode);
        }
    }

    function login() {
        $this->ensurePost();

        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        if (empty($email) || empty($password)) {
            $this->fail("All fields are required.");
        }

        $this->validateEmail($email);
        $this->validatePassword($password);

        try {
            $this->userModel->login($email, $password);
            header("Location: /1PHPD/");
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    function logout() {
        $this->userModel->logout();
        header("Location: /1PHPD/auth/");
    }

    function password() {
        if (!$this->userModel->isLoggedIn()) {
            $this->redirectToProfile(true);
        }

        $this->ensurePost();

        $oldPassword = htmlspecialchars($_POST["old_password"]);
        $newPassword = htmlspecialchars($_POST["new_password"]);

        if (empty($oldPassword) || empty($newPassword)) {
            $this->fail("All fields are required.", true);
        }

        try {
            $this->validatePassword($oldPassword, true);
            $this->validatePassword($newPassword, true);

            if ($oldPassword === $newPassword) {
                $this->fail("The new password must be different from the old one.", true);
            }

            $this->userModel->checkPassword($oldPassword, null, $_SESSION["userId"]);

            $this->userModel->changePassword($_SESSION["userId"], $newPassword);

            $shouldDisconnectAll = isset($_POST["disconnect_all"]) && $_POST["disconnect_all"] == "on";
            if ($shouldDisconnectAll) {
                $this->userModel->logoutEverything($_SESSION["userId"]);
            } else {
                $_SESSION["successMessage"] = "Password changed successfully.";
            }

            $this->redirectToProfile();
        } catch (Exception $e) {
            $_SESSION["errorMessage"] = $e->getMessage();
            $this->redirectToProfile(true);
        }
    }

    private function redirectToProfile($error = false) {
        if ($error) {
            http_response_code(400);
        }
        header("Location: /1PHPD/my/profile");
        exit;
    }
}