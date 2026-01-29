<?php


namespace Thomas\PhpBlog\Models;
use PDO;



class UserModel
{
    public function __construct(private PDO $pdo)
    {
    }



    public function findByEmail(string $email): array|false
    {
        $stmt = $this->pdo->prepare("select * from users where email = :email limit 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public function storeUser(array $data)
    {

        try {
            $stmt = $this->pdo->prepare("insert into users (name, email, password) values (:name, :email, :password)");
            $stmt->execute($data);
            return true;
        } catch (\PDOException $e) {
            throw new \Exception('Could not create user', 0, $e);


        }
    }
}
