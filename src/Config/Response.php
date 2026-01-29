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