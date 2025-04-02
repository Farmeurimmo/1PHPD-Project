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


    }
}