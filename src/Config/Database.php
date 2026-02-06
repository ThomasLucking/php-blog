<?php

namespace Thomas\PhpBlog\Config;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;
    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            $dbpath = __DIR__ . '/../../Data/database.db';

            try {
                $dsn = "sqlite:" . $dbpath;
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];

                self::$instance = new PDO($dsn, null, null, $options);
            } catch (PDOException $e) {
                throw $e;

            }
        }

        return self::$instance;
    }
}
