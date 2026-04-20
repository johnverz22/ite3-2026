<?php
namespace App\Controllers;

abstract class Controller {
    
    /**
     * Helper function to render views
     * 
     * @param string $viewName The name of the view file (e.g., 'home')
     * @param array $data Associative array of data to pass to the view
     */
    protected function render($viewName, $data = []) {
        // 1. Extract data array into variables 
        extract($data);

        // 2. Start Output Buffering
        ob_start();
        
        // 3. Include the specific page view
        include __DIR__ . "/../Views/{$viewName}.php";
        
        // 4. Save the captured HTML into $content and stop buffering
        $content = ob_get_clean();

        // 5. Include the master layout
        include __DIR__ . "/../Views/layouts/main.php";
    }
}
