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
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        if (!empty($title) && !empty($content)) {
            $postModel = new Post();
            $postModel->create($title, $content);
        }

        header('Location: /ite3/home');
        exit;
    }

    public function edit($id) {
        $postModel = new Post();
        $post = $postModel->find($id);

        if (!$post) {
            echo "Post not found!";
            return;
        }

        $this->render('post-edit', [
            'post' => $post
        ]);
    }

    public function update() {
        $id = $_POST['id'] ?? null;
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        if ($id && !empty($title) && !empty($content)) {
            $postModel = new Post();
            $postModel->update($id, $title, $content);
        }

        header('Location: /ite3/home');
        exit;
    }

    public function delete($id) {
        $postModel = new Post();
        $postModel->delete($id);

        header('Location: /ite3/home');
        exit;
    }
}