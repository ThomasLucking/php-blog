<?php
namespace Thomas\PhpBlog\Services;


class AuthService
{


    public function PasswordSecurityCheck(string $password)
    {
            $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/';
            $passwordMatch = preg_match($password_pattern, $password);

            if(!$passwordMatch) {
                return false;
            }
            return $passwordMatch;

    }
    public function hashPassword(string $password): string|false
    {
        
        return password_hash($password, PASSWORD_DEFAULT);
    }
}