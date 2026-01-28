<?php

namespace Thomas\PhpBlog\Config;


class Router
{
    public $routes = [];

    public function get(string $uri, callable $action): void
    {
        $this->routes['GET'][$uri] = $action;
    }
    public function post(string $uri, callable $action): void
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function resolve(string $uri, string $method): ?callable
    {
        return $this->routes[$method][$uri] ?? null;
    }


}

