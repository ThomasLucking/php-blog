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
            $stmt = $this->pdo->prepare("insert into posts (title, image, content, user_id, category_id) values (:title, :image, :content, :user_id, :category_id)");
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
        if (empty($data)) {
            return false;
        }
        $fields = [];
        foreach ($data as $column => $value) {
            $fields[] = "{$column} = :{$column}";
        }
        $setClause = implode(', ', $fields);
        $sql = "update posts set {$setClause} where id = :id";
        $stmt = $this->pdo->prepare($sql);
        $data['id'] = $id;


        return $stmt->execute($data);
    }


    public function getAllCategories(): array
    {
        $sql = "select id, name from categories order by name asc";

        $stmt = $this->pdo->query($sql);


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function linkPostsWithCategory()
    {
        $stmt = $this->pdo->query('
        select posts.*, categories.name as category_name
        from posts
        left join categories on posts.category_id = categories.id
        order by posts.id desc
    ');


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}