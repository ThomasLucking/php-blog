<?php

namespace Thomas\PhpBlog\Controllers;
use Thomas\PhpBlog\Config\Flash;
use Thomas\PhpBlog\Models\UserModel;
use Thomas\PhpBlog\Services\Authorization;
use Thomas\PhpBlog\Services\AuthService;
use Thomas\PhpBlog\Config\Redirector;

class AuthController
{
    public function __construct(
        private UserModel $model,
        private AuthService $authService,

    ) {
    }


    public function create()
    {
        // $errors = Flash::getValue('errors') ?? [];
        require_once __DIR__ . "/../../views/auth/register.php";
    }

    public function login()
    {
        require_once __DIR__ . "/../../views/auth/login.php";

    }

    public function editForm()
    {
        require_once __DIR__ . "/../../views/auth/accountInfo.php";

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

        if (!$UserData['name'])
            $errors['name'] = "Name is required.";

        if (!$UserData["email"])
            $errors['email'] = "Valid email is required.";
        if (!$rawPassword)
            $errors['password'] = "Password is required.";


        if ($UserData['email']) {
            $existingUser = $this->model->findByEmail($UserData['email']);
            if ($existingUser)
                $errors['email'] = 'This Email is already registered';
        }

        if ($rawPassword) {
            $checkPassword = $this->authService->PasswordSecurityCheck($rawPassword);
            if (!$checkPassword) {
                $errors['password'] = "Password must be at least 8 chars with Uppercase, Lowercase, Number, and Special char.";
            }
        }

        if (!empty($errors)) {
            Flash::setValue('errors', $errors);
            Redirector::redirect("/register");
            exit;
        }



        $hashedPassword = $this->authService->hashPassword(password: $rawPassword);
        $this->model->storeUser([
            "name" => $UserData["name"],
            "email" => $UserData["email"],
            "password" => $hashedPassword,
            "role" => 'user'
        ]);

        Flash::setValue("notification", [
            "type" => "success",
            "message" => "Account created successfully"
        ]);

        Redirector::redirect("/login");
    }


    public function loginAuth()
    {
        $rawPassword = $_POST['password'] ?? null;
        $userEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $user = $this->model->findByEmail($userEmail);

        if ($user && password_verify($rawPassword, $user['password'])) {
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['user_email'] = $userEmail;

            $_SESSION['user_role'] = $user['role'];

            Flash::setValue("notification", [
                "type" => "success",
                "message" => "Logged in successfully"
            ]);
            Redirector::redirect('/');
            exit;

        } else {
            Flash::setValue('errors', ['login' => 'invalid email or password']);
            Redirector::redirect('/login');
            exit;
        }

    }

    public function editCredentials()
    {
        $errors = [];
        $id = Authorization::getUserId();
        $user = $this->model->findById($id);

        
        if (!$user) {
            Redirector::redirect('/login');
            exit;
        }

        
        $currentPassword = $_POST['Original_password'] ?? '';
        $newEmail = filter_input(INPUT_POST, 'Edit_email', FILTER_VALIDATE_EMAIL); // Use Validate, not Sanitize
        $newName = trim($_POST['Edit_name'] ?? '');
        $newPassword = $_POST['New_password'] ?? '';

    
        if (empty($currentPassword) || !password_verify($currentPassword, $user['password'])) {
            $errors['Original_password'] = "Verification failed: Current password incorrect.";
        }


        if (!empty($newName) && $newName !== $user['name']) {
            if (strlen($newName) < 2) {
                $errors['Edit_name'] = "Name is too short.";
            }
        }

      
        if ($newEmail && $newEmail !== $user['email']) {
            if ($this->model->findByEmail($newEmail)) {
                $errors['Edit_email'] = "Email already in use.";
            }
        }

    
        if (!empty($newPassword)) {
            if (!$this->authService->PasswordSecurityCheck($newPassword)) {
                $errors['New_password'] = "Password does not meet security requirements.";
            }
        }

   
        if (!empty($errors)) {
            Flash::setValue('errors', $errors);
            Redirector::redirect('/editInfo'); 
            exit;
        }

        $updateData = [
            'name' => !empty($newName) ? $newName : $user['name'],
            'email' => $newEmail ?: $user['email'],
            'password' => !empty($newPassword)
                ? password_hash($newPassword, PASSWORD_DEFAULT)
                : $user['password']
        ];

        $this->model->updateUser($id, $updateData);


        $_SESSION['email'] = $updateData['email'];
        $_SESSION['name'] = $updateData['name'];

        Flash::setValue("notification", ["type" => "success", "message" => "Profile updated!"]);
        Redirector::redirect('/');
        exit;
    }

    public function logout()
    {
        $_SESSION = [];
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        session_destroy();
        Redirector::redirect('/');
        exit;

    }





}

