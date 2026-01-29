<?php

namespace Thomas\PhpBlog\Controllers;
use Thomas\PhpBlog\Models\UserModel;
use Thomas\PhpBlog\Services\AuthService;
use Thomas\PhpBlog\Config\Redirector as Redirector;


class AuthController
{
    public function __construct(
        private UserModel $model,
        private AuthService $authService,

    ) {
    }

    public function create()
    {
        $errors = $_SESSION['errors'] ?? [];
        unset($_SESSION['errors']);
        require_once __DIR__ . "/../../views/auth/register.php";
    }

    public function login()
    {
        require_once __DIR__ . "/../../views/auth/login.php";

    }


    public function storeUser()
{
    $errors = [];

    $UserData = filter_input_array(INPUT_POST, [
        'name' => FILTER_SANITIZE_SPECIAL_CHARS,
        'email' => FILTER_SANITIZE_EMAIL,
    ]);
    $rawPassword = $_POST['password'] ?? null;

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        Redirector::redirect("/register");
        exit;
    }


    if (!$UserData['name']) $errors['name'] = "Name is required.";
    if (!$UserData["email"]) $errors['email'] = "Valid email is required.";
    if (!$rawPassword) $errors['password'] = "Password is required.";


    if ($UserData['email']) {
        $existingUser = $this->model->findByEmail($UserData['email']);
        if ($existingUser) $errors['email'] = 'This Email is already registered';
    }

    if ($rawPassword) {
        $checkPassword = $this->authService->PasswordSecurityCheck($rawPassword);
        if (!$checkPassword) {
            $errors['password'] = "Password must be at least 8 chars with Uppercase, Lowercase, Number, and Special char.";
        }
    }


    if (!empty($errors)) {
        $_SESSION['errors'] = $errors; 
        Redirector::redirect("/register");
        exit; 
    }




    $hashedPassword = $this->authService->hashPassword($rawPassword);
    $this->model->storeUser([
        "name" => $UserData["name"],
        "email" => $UserData["email"],
        "password" => $hashedPassword,
    ]);

    Redirector::redirect("/login");
}
}

