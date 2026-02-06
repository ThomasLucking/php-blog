<?php

namespace Thomas\PhpBlog\Config;

class Router
{
    public $routes = [];

    private ?string $lastMethod = null;
    private ?string $lastUri = null;

    public function get(string $uri, callable $action): self
    {
        $this->routes['GET'][$uri] = [
            'action' => $action,
            'middlewares' => []
        ];

        $this->lastMethod = 'GET';
        $this->lastUri = $uri;
        return $this;
    }

    public function post(string $uri, callable $action): self
    {
        $this->routes['POST'][$uri] = [
            'action' => $action,
            'middlewares' => []
        ];
        $this->lastMethod = 'POST';
        $this->lastUri = $uri;

        return $this;
    }

    public function middleware(string $middlewareClass): self
    {
        if ($this->lastMethod === null || $this->lastUri === null) {
            throw new \LogicException('Cannot add middleware without a route being defined first.');
        }
        $this->routes[$this->lastMethod][$this->lastUri]['middlewares'][] = $middlewareClass;

        return $this;
    }

    public function resolve(string $uri, string $method)
    {
        $route = $this->routes[$method][$uri] ?? null;

        if ($route) {

            foreach ($route['middlewares'] as $middlewareClass) {
                if (class_exists($middlewareClass)) {
                    $middleware = new $middlewareClass();
                    if (method_exists($middleware, 'handle')) {
                        $middleware->handle();
                    }
                }
            }


            return $route['action'];
        }

        return null;
    }
}
