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

    // Fetch a single post by its slug
    public function findBySlug($slug) {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE slug = ?");
        $stmt->execute([$slug]);
        return $stmt->fetch();
    }

    // Insert a new post
    public function create($title, $slug, $content) {
        $stmt = $this->db->prepare("INSERT INTO posts (title, slug, content) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $slug, $content]);
    }

    // Update an existing post
    public function update($id, $title, $slug, $content) {
        $stmt = $this->db->prepare("UPDATE posts SET title = ?, slug = ?, content = ? WHERE id = ?");
        return $stmt->execute([$title, $slug, $content, $id]);
    }

    // Delete a post
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = ?");
        return $stmt->execute([$id]);
    }
}