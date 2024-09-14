<?php

namespace src\core;

class Router {
    private $routes = [];

    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }

    public function put($uri, $action) {
        $this->routes['PUT'][$uri] = $action;
    }

    public function patch($uri, $action) {
        $this->routes['PATCH'][$uri] = $action;
    }

    public function delete($uri, $action) {
        $this->routes['DELETE'][$uri] = $action;
    }

    public function addRouter(Router $otherRouter) {
        foreach ($otherRouter->routes as $method => $methodRoutes) {
            foreach ($methodRoutes as $uri => $action) {
                $this->routes[$method][$uri] = $action;
            }
        }
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($this->routes[$method][$uri])) {
            call_user_func($this->routes[$method][$uri]);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Route not found"]);
        }
    }
}