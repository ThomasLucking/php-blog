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
            throw new \Exception('Could not create the post.', 0, $e);


        }
    }
    public function fetchall()
    {
        try {
            $stmt = $this->pdo->prepare('select * from posts');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception('Could not create the post.', 0, $e);


        }

    }

    public function findId($id)
    {
        $stmt = $this->pdo->prepare('select * from posts where id = ?');
        $stmt->execute([$id]);

        return $stmt->fetch();
    }
    public function update($id, array $data)
    {
        $stmt = $this->pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
        return $stmt->execute([
            ':title' => $data['title'],
            ':content' => $data['content'],
            ':id' => $id
        ]);
    }


}