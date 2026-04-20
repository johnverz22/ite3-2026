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
}