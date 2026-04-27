<?php
session_start();

// 1. Load Composer Autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// 2. Load Environment Variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

error_reporting(E_ALL);
if ($_ENV['APP_DEBUG'] === 'true') {
    ini_set('display_errors', 1);
}

use App\Core\Router;

// 1. Initialize the Router
$router = new Router();

// 2. Load the Routes (Separated into its own file)
require __DIR__ . '/../app/routes.php';

// 3. Capture the current request
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$basePath = trim($_ENV['APP_BASE_PATH'] ?? '', '/');
if (!empty($basePath)) {
    $uri = preg_replace("#^" . preg_quote($basePath) . "/?#", '', $uri);
}

if ($uri === '' || $uri === 'index.php') { $uri = 'home'; }

$method = $_SERVER['REQUEST_METHOD'];

// 4. Resolve the route!
$router->resolve($uri, $method);