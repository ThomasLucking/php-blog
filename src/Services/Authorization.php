<?php

namespace Thomas\PhpBlog\Services;

use Thomas\PhpBlog\Models\UserModel;
use Thomas\PhpBlog\Config\Database;


class Authorization
{

    public function __construct(


    ) {
    }
    public static function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']) && session_status() === PHP_SESSION_ACTIVE;
    }

    // public static function getUserId(): ?int
    // {
    //     return self::isLoggedIn() ? (int)$_SESSION['user_id'] : null;
    // }

    public static function canAccessPost(int $postId): bool
    {
        if (!self::isLoggedIn()) {
            return false;
        }

        $userId = (int)$_SESSION['user_id'];
        
        $pdo = Database::getConnection();
        $model = new UserModel($pdo);
        return $model->linkUserWithPost($userId, $postId);
    }
}