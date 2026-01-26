<?php

namespace Thomas\PhpBlog\Models;

use PDO;

class PostModel
{
    public function __construct(private PDO $pdo)
    {
    }

    public function create(array $data)
    {

        try {
            $stmt = $this->pdo->prepare("insert into posts (title, image, content, user_id) values (:title, :image, :content, :user_id)");
            $stmt->execute($data);
            return true;
        } catch (\PDOException $e) {
            throw new \Exception(message: $e->getMessage());


        }
    }
    
}