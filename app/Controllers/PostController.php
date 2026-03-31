<?php
namespace App\Controllers;

class PostController {
    public function index() {
        echo "<h1>All Blog Posts</h1><p>Listing all content from the database...</p>";
    }

    public function create() {
        echo "<h1>Create New Post</h1><p>Show a form here.</p>";
    }
}