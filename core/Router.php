<?php
namespace core;

class Router {
    protected $routes = [];

    public function add($route, $callback) {
        $this->routes[$route] = $callback;
    }

    public function dispatch($url) {
        foreach ($this->routes as $route => $callback) {
            if ($url == $route) {
                return call_user_func($callback);
            }
        }
        
        echo "404 Not Found";
    }
}
