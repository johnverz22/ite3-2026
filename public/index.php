<?php
// ... keep the autoloader code from Handout 1 ...

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