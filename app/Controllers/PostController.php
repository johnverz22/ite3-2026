<?php
namespace App\Controllers;

class PostController {
    
    // Helper function to render views
    protected function render($viewName, $data = []) {
        // 1. Extract data array into variables 
        // (e.g., ['title' => 'Home'] becomes $title = 'Home')
        extract($data);

        // 2. Start Output Buffering (Capture everything)
        ob_start();
        
        // 3. Include the specific page view
        include __DIR__ . "/../views/{$viewName}.php";
        
        // 4. Save the captured HTML into $content and stop buffering
        $content = ob_get_clean();

        // 5. Include the master layout (which uses the $content variable)
        include __DIR__ . "/../views/layouts/main.php";
    }

    public function index() {
        $this->render('home', [
            'title' => 'Welcome to DevBlog'
        ]);
    }

    public function create() {
        $this->render('post-create');
    }
}