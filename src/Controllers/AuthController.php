<?php

namespace Thomas\PhpBlog\Controllers;
use Thomas\PhpBlog\Models\UserModel;
use Thomas\PhpBlog\Services\AuthService;
use Thomas\PhpBlog\Config\Direct as Redirector;


class AuthController
{
    public function __construct(
        private UserModel $model,
        private AuthService $authService,

    ) {
    }

    public function create()
    {
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
            Redirector::redirect("/create");

        }

        if (!$UserData['name'])
            $errors['name'] = "Name is required.";
        if (!$UserData["email"])
            $errors['email'] = "Valid email is required.";
        if (!$rawPassword)
            $errors['password'] = "Password is required.";

        if(!empty($errors)){
            Redirector::redirect("/register");
        }

        $hashedPassword = $this->authService->hashPassword($rawPassword,);
        $existingUser  =$this->model->findByEmail($UserData['email']);
        if($existingUser) {
            $errors['email'] = 'This Email is already registered';
        }

        $UserDataPost = [
            "name" => $UserData["name"],
            "email" => $UserData["email"],
            "password" => $hashedPassword,

        ];

        $this->model->StoreUser($UserDataPost);
        Redirector::redirect("/login");
        

    }
}

