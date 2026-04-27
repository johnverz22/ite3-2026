<?php

namespace App\Models;

use PDO;

class User {
    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    // Find a user by their username
    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
}
