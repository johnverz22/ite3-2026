<?php
namespace App\Models;

use App\Config\Database;

abstract class Model {
    protected $db;

    public function __construct() {
        // Automatically get the shared database connection
        $this->db = Database::getConnection();
    }
}