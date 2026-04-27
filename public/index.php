<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// PSR-4 Style Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) require $file;
});

use App\Core\Router;

// 1. Initialize the Router
$router = new Router();

// 2. Load the Routes (Separated into its own file)
require __DIR__ . '/../app/routes.php';

// 3. Capture the current request
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$uri = str_replace('ite3/', '', $uri);
if ($uri === '' || $uri === 'index.php') { $uri = 'home'; }

$method = $_SERVER['REQUEST_METHOD'];

// 4. Resolve the route!
$router->resolve($uri, $method);