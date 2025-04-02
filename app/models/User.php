<?php

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    function register($email, $username, $password) {
        $sql = "INSERT INTO users (email, username, password_hashed) VALUES (:email, :username, :password_hashed)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password_hashed', $password);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            throw new Exception("Failed to register user");
        }

        try {
            $this->generateSession($this->db->lastInsertId());
        } catch (Exception $e) {
            throw new Exception("Failed to create session");
        }
    }

    function generateSession($userId) {
        $_SESSION["userId"] = $userId;

        $token = bin2hex(openssl_random_pseudo_bytes(32));
        $token = password_hash($token, PASSWORD_DEFAULT);

        $_SESSION["token"] = $token;

        $sql = "INSERT INTO sessions (user_id, token, expiration_date) VALUES (:user_id, :token, :expiration_date) 
ON DUPLICATE KEY UPDATE token = :token, expiration_date = :expiration_date";

        $stmt = $this->db->prepare($sql);

        $expirationDate = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expiration_date', $expirationDate);

        if (!$stmt->execute()) {
            throw new Exception("Failed to create session");
        }
    }

    function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!password_verify($password, $result['password_hashed'])) {
            throw new Exception("Invalid credentials");
        }

        if ($stmt->rowCount() == 0) {
            throw new Exception("User not found");
        }

        try {
            $this->generateSession($result['id']);
        } catch (Exception $e) {
            throw new Exception("Failed to create session");
        }
    }

    function isLoggedIn() {
        if (isset($_SESSION["userId"]) && isset($_SESSION["token"])) {
            $sql = "SELECT * FROM sessions WHERE user_id = :user_id AND token = :token";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':user_id', $_SESSION["userId"]);
            $stmt->bindParam(':token', $_SESSION["token"]);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                $expirationDate = new DateTime($result['expiration_date']);
                $currentDate = new DateTime();
                if ($currentDate > $expirationDate) {
                    return false;
                }
                return true;
            }
        }

        return false;
    }
}