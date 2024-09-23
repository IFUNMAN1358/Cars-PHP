<?php

namespace src\core;

use src\security\JwtFilter;

class Router {

    private array $routes = [];

    public function get($uri, $action, $roles): void
    {
        $this->routes['GET'][$uri] = ['action' => $action, 'roles' => $roles];
    }

    public function post($uri, $action, $roles): void
    {
        $this->routes['POST'][$uri] = ['action' => $action, 'roles' => $roles];
    }

    public function put($uri, $action, $roles): void
    {
        $this->routes['PUT'][$uri] = ['action' => $action, 'roles' => $roles];
    }

    public function patch($uri, $action, $roles): void
    {
        $this->routes['PATCH'][$uri] = ['action' => $action, 'roles' => $roles];
    }

    public function delete($uri, $action, $roles): void
    {
        $this->routes['DELETE'][$uri] = ['action' => $action, 'roles' => $roles];
    }

    public function addRouter(Router $otherRouter): void
    {
        foreach ($otherRouter->routes as $method => $methodRoutes) {
            foreach ($methodRoutes as $uri => $action) {
                $this->routes[$method][$uri] = $action;
            }
        }
    }

    public function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];
            $action = $route['action'];
            $roles = $route['roles'];

            if ($roles) {
                JwtFilter::handle(function() use ($action) {
                    call_user_func($action);
                }, $roles);
            } else {
                call_user_func($action);
            }
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Route not found"]);
        }
    }
}