<?php

namespace Thomas\PhpBlog\Middleware;

use Thomas\PhpBlog\Services\Authorization;
use Thomas\PhpBlog\Config\Redirector;

class Middleware
{
    public function handle()
    {
        if (!Authorization::isLoggedIn()) {
            Redirector::redirect('/login');
            exit;
        }
    }
}
