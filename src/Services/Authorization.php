<?php

namespace Thomas\PhpBlog\Services;

use Thomas\PhpBlog\Models\UserModel;
use Thomas\PhpBlog\Config\Database;


class Authorization
{

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
        $pdo = Database::getConnection();
        $model = new UserModel($pdo);

        $userId = (int)$_SESSION['user_id'];
        return $model->linkUserWithPost($userId, $postId);
    }
}