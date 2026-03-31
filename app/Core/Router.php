<?php
namespace App\Core;

class Router {
    protected $routes = [];

    // 1. Register a GET route
    public function get($uri, $controller) {
        $this->routes['GET'][$uri] = $controller;
    }

    // 2. Register a POST route (for forms)
    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
    }

    // 3. The Dispatcher: This finds and runs the controller
    public function resolve($uri, $method) {
        $controllerAction = $this->routes[$method][$uri] ?? null;

        if (!$controllerAction) {
            http_response_code(404);
            echo "404 - Page Not Found";
            return;
        }

        // Split "PostController@index" into Class and Method
        [$controller, $action] = explode('@', $controllerAction);
        $controller = "App\\Controllers\\" . $controller;

        // Instantiate the controller and call the method
        if (class_exists($controller)) {
            $controllerInstance = new $controller();
            if (method_exists($controllerInstance, $action)) {
                $controllerInstance->$action();
            } else {
                echo "Method $action not found in $controller";
            }
        } else {
            echo "Controller $controller not found";
        }
    }
}