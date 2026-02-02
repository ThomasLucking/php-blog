<?php

namespace Thomas\PhpBlog\Services;

use Thomas\PhpBlog\Models\UserModel;
use Thomas\PhpBlog\Config\Database;


class Authorization
{
    private static ?UserModel $userModel = null;

    public static function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']) && session_status() === PHP_SESSION_ACTIVE;
    }

    // public static function getUserId(): ?int
    // {
    //     return self::isLoggedIn() ? (int)$_SESSION['user_id'] : null;
    // }

    private static function getUserModel(): UserModel {
        if (self::$userModel === null) {
            self::$userModel = new UserModel(Database::getConnection());
        }
        return self::$userModel;
    }
    
    public static function canAccessPost(int $postId): bool {
        if (!self::isLoggedIn()) {
            return false;
        }
        
        $userId = (int)$_SESSION['user_id'];
        return self::getUserModel()->linkUserWithPost($userId, $postId);
    }
    
    
}