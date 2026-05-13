<?php
namespace App\Controllers;

use App\Models\Post;
use App\Helpers\Validator;
use App\Services\PostService;

class PostController extends Controller {

    // Helper to check if user is logged in
    protected function checkAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /ite3/login');
            exit;
        }
    }

    public function index() {
        $postModel = new Post();
        $posts = $postModel->all();

        $this->render('home', [
            'posts' => $posts
        ]);
    }

    public function create() {
        $this->checkAuth();
        $this->render('post-create');
    }

    public function store() {
        $this->checkAuth();
        
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        // Validate
        Validator::clearErrors();
        Validator::required($title, 'title');
        Validator::required($content, 'content');

        if (Validator::hasErrors()) {
            return $this->render('post-create', [
                'errors' => Validator::getErrors(),
                'old' => $_POST
            ]);
        }

        // Service Layer: Generate Slug
        $slug = PostService::generateSlug($title);

        $postModel = new Post();
        $postModel->create($title, $slug, $content);

        header('Location: /ite3/home');
        exit;
    }

    public function edit($id) {
        $this->checkAuth();
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
        $this->checkAuth();
        
        $id = $_POST['id'] ?? null;
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        // Validate
        Validator::clearErrors();
        Validator::required($title, 'title');
        Validator::required($content, 'content');

        if (Validator::hasErrors()) {
            $postModel = new Post();
            $post = $postModel->find($id);
            return $this->render('post-edit', [
                'post' => $post,
                'errors' => Validator::getErrors()
            ]);
        }

        // Service Layer: Generate Slug
        $slug = PostService::generateSlug($title);

        $postModel = new Post();
        $postModel->update($id, $title, $slug, $content);

        header('Location: /ite3/home');
        exit;
    }

    public function delete($id) {
        $this->checkAuth();
        $postModel = new Post();
        $postModel->delete($id);

        header('Location: /ite3/home');
        exit;
    }

    public function show($slug) {
        $postModel = new Post();
        $post = $postModel->findBySlug($slug);

        if (!$post) {
            echo "Post not found!";
            return;
        }

        $this->render('post-show', [
            'post' => $post
        ]);
    }
}