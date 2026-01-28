<?php
namespace Thomas\PhpBlog\Services;


class AuthService
{
    public function hashPassword(string $password): string|false
    {
   
        if (strlen($password) < 8) {
            return false; 
        }

        return password_hash($password, PASSWORD_DEFAULT);
    }
}