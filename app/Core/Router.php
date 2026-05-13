<?php
namespace App\Core;

class Router
{
    protected $routes = [];

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function resolve($uri, $method)
    {
        $routes = $this->routes[$method];

        foreach ($routes as $route => $controllerAction) {
            // Convert route pattern {id} to regex
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);

            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches); // Remove the full match
                [$controller, $action] = explode('@', $controllerAction);
                $controller = "App\\Controllers\\" . $controller;

                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
                    call_user_func_array([$controllerInstance, $action], $matches);
                    return;
                }
            }
        }

        http_response_code(404);
        echo "404 - Page Not Found";
    }
}
