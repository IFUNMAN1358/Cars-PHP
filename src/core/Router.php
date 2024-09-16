<?php

namespace src\core;

class Router {

    private array $routes = [];

    public function get($uri, $action, $filters = []): void
    {
        $this->routes['GET'][$uri] = ['action' => $action, 'filters' => $filters];
    }

    public function post($uri, $action, $filters = []): void
    {
        $this->routes['POST'][$uri] = ['action' => $action, 'filters' => $filters];
    }

    public function put($uri, $action, $filters = []): void
    {
        $this->routes['PUT'][$uri] = ['action' => $action, 'filters' => $filters];
    }

    public function patch($uri, $action, $filters = []): void
    {
        $this->routes['PATCH'][$uri] = ['action' => $action, 'filters' => $filters];
    }

    public function delete($uri, $action, $filters = []): void
    {
        $this->routes['DELETE'][$uri] = ['action' => $action, 'filters' => $filters];
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
            $filters = $route['filters'];
            $action = $route['action'];

            $this->applyFilters($filters, $action);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Route not found"]);
        }
    }

    private function applyFilters(array $filters, callable $action): void
    {
        $pipeline = array_reduce(array_reverse($filters), function($next, $filter) {
            return function() use ($next, $filter) {
                $filter::handle($next);
            };
        }, function() use ($action) {
            call_user_func($action);
        });

        $pipeline();
    }
}