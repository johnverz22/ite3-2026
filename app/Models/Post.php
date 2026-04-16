<?php
namespace App\Models;

class Post extends Model {
    
    // Fetch all posts from the database
    public function all() {
        $stmt = $this->db->query("SELECT * FROM posts ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    // Fetch a single post by its ID
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Insert a new post
    public function create($title, $content) {
        $stmt = $this->db->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
        return $stmt->execute([$title, $content]);
    }
}