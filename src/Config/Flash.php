<?php

namespace Thomas\PhpBlog\Config;

class Flash
{
    public static function setValue($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function getValueAndDelete($key)
    {
        if (isset($_SESSION[$key])) {
            $tempVar = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $tempVar;
        }
    }
}
