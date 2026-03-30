<?php
/**
 * HANDOUT 1: THE FRONT CONTROLLER & AUTOLOADER
 * This file is the single entry point for the entire application.
 */

// 1. Setup Error Reporting (Crucial for beginners to see what's wrong)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. Define the Manual Autoloader
// This function runs automatically whenever you try to use a class that isn't loaded yet.
spl_autoload_register(function ($class) {
    
    // The namespace prefix we are using for our app
    $prefix = 'App\\';

    // The physical directory where our source files live (one level up from /public)
    $base_dir = __DIR__ . '/../app/';

    // Check if the class being called starts with 'App\'
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return; // It's not our class, ignore it.
    }

    // Get the relative class name (e.g., Controllers\PostController)
    $relative_class = substr($class, $len);

    // Replace the namespace backslash (\) with a directory slash (/)
    // App\Controllers\PostController becomes Controllers/PostController.php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // If the file exists on the disk, require it!
    if (file_exists($file)) {
        require $file;
    } else {
        echo "Autoloader Error: Could not find file at $file";
    }
});

// 3. Determine the Request Path (The Router Warmer)
// We clean the URL to see where the user is trying to go.
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Since we are in a subfolder (/devblog/), we remove it from the path
$uri = str_replace('ite3/', '', $uri);

// Default to 'home' if the path is empty
if ($uri === '' || $uri === 'index.php') {
    $uri = 'home';
}

echo "<h1>DevBlog CMS Engine</h1>";
echo "<strong>Requested Route:</strong> " . $uri . "<br><br>";

// 4. TEST: Trying to use a class that doesn't exist yet
// This will trigger the spl_autoload_register function above.
use App\Controllers\PostController;

if (class_exists('App\Controllers\PostController')) {
    $test = new PostController();
} else {
    echo "Please create app/Controllers/PostController.php to test the autoloader!";
}