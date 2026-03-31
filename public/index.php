<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function ($class) {
    
    $prefix = 'App\\';

    $base_dir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return; // It's not our class, ignore it.
    }

    $relative_class = substr($class, $len);

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // If the file exists on the disk, require it!
    if (file_exists($file)) {
        require $file;
    } else {
        echo "Autoloader Error: Could not find file at $file";
    }
});

use App\Core\Router;

// 1. Initialize the Router
$router = new Router();

// 2. Define our Routes (The Map)
$router->get('home', 'PostController@index');
$router->get('post/create', 'PostController@create');

// 3. Capture the current request
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$uri = str_replace('ite3/', '', $uri);
if ($uri === '' || $uri === 'index.php') { $uri = 'home'; }

$method = $_SERVER['REQUEST_METHOD'];

// 4. Resolve the route!
$router->resolve($uri, $method);