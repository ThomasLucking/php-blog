<?php

namespace Thomas\PhpBlog\Config;


class Response
{
    public static function redirect(string $url, int $code = 303): void
    {
        http_response_code($code);
        header("Location: $url");
        exit;
    }
}



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

    // $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    // $method = $_SERVER['REQUEST_METHOD'];

    public function resolve(string $uri, string $method): ?callable
    {
        return $this->routes[$method][$uri] ?? null;
    }


}

