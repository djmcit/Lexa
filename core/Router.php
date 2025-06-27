<?php
// core/Router.php

class Router {
    private $routes = [];

    public function post($path, $handler) {
        $this->routes['POST'][$path] = $handler;
    }

    public function get($path, $handler) {
        $this->routes['GET'][$path] = $handler;
    }

    public function resolve() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $handler = $this->routes[$method][$uri] ?? null;

        if ($handler) {
            echo call_user_func($handler);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Ruta no encontrada']);
        }
    }
}
