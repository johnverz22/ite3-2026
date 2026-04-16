<?php
namespace App\Controllers;

use App\Models\Post;

class PostController extends Controller {

    public function index() {
        $postModel = new Post();
        $posts = $postModel->all();

        $this->render('home', [
            'posts' => $posts
        ]);
    }

    public function create() {
        $this->render('post-create');
    }

    public function store() {
        // Simple logic for handling POST requests (to be expanded)
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        if (!empty($title) && !empty($content)) {
            $postModel = new Post();
            $postModel->create($title, $content);
        }

        header('Location: /ite3/home');
        exit;
    }
}