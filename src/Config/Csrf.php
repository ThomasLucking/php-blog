<?php

namespace Thomas\PhpBlog\Config;

class Csrf
{
    public static function Protection($token)
    {
        if (!hash_equals($_SESSION[$token], $_POST['csrf_token'] ?? '')) {
            throw new \Exception('Invalid CSRF token');
        }
    }


}
