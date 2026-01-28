<?php

namespace Thomas\PhpBlog\Config;


class Direct
{
    public static function redirect(string $url, int $code = 303): void
    {
        http_response_code($code);
        header("Location: $url");
        exit;
    }
}