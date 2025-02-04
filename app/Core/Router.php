<?php

namespace App\Core;

class Router {
    private $routes = [];

    public function get($uri, $controller) {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
    }

    public function dispatch() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method][$uri])) {
            [$controller, $action] = $this->routes[$method][$uri];
            $controllerInstance = new $controller();
            call_user_func([$controllerInstance, $action]);
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}
