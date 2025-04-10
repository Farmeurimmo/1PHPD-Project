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
            $this->generateSession($this->db->lastInsertId(), $username);
        } catch (Exception $e) {
            throw new Exception("Failed to create session");
        }
    }

    function generateSession($userId, $username) {
        $_SESSION["userId"] = $userId;

        $token = bin2hex(openssl_random_pseudo_bytes(32));
        $token = password_hash($token, PASSWORD_DEFAULT);

        $_SESSION["token"] = $token;
        $_SESSION["username"] = $username;

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
            $this->generateSession($result['id'], $result['username']);
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
                    $this->logout();
                    return false;
                }
                return true;
            }

            $this->logout();
        }

        return false;
    }

    function logout() {
        if (isset($_SESSION["userId"]) && isset($_SESSION["token"])) {
            $sql = "DELETE FROM sessions WHERE user_id = :user_id AND token = :token";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':user_id', $_SESSION["userId"]);
            $stmt->bindParam(':token', $_SESSION["token"]);

            $stmt->execute();

            unset($_SESSION["userId"]);
            unset($_SESSION["token"]);
            unset($_SESSION["username"]);
            unset($_COOKIE["cart"]);
        }
    }

    function getUserFilms($userId) {
        $sql = "SELECT vods.id, vods.image, vods.title, vods.short_plot, vods.director_id, vods.price, vods.release_date,
            directors.first_name, directors.last_name,
            GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.name SEPARATOR ', ') AS categories_array
        FROM films_purchased
        INNER JOIN vods ON films_purchased.vod_id = vods.id
        INNER JOIN vod_categories ON vod_categories.vod_id = vods.id
        INNER JOIN categories ON vod_categories.category_id = categories.id
        INNER JOIN directors ON vods.director_id = directors.id
        WHERE films_purchased.user_id = :user_id
        GROUP BY vods.id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getUserById($userId) {
        $sql = "SELECT * FROM users WHERE id = :user_id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            throw new Exception("User not found");
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        unset($result['password_hashed']);

        return $result;
    }

    function checkoutCart($userId, $cart) {
        $sql = "INSERT INTO films_purchased (user_id, vod_id) VALUES (:user_id, :vod_id)";

        $stmt = $this->db->prepare($sql);

        foreach ($cart as $vodId => $quantity) {
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':vod_id', $vodId);

            try {
                $stmt->execute();
            } catch (Exception $e) {
                throw new Exception("Already owning the film: " . $vodId);
            }
        }

        $_SESSION["brought"] = $cart;

        unset($_COOKIE["cart"]);
    }
}