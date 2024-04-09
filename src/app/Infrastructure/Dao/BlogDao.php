<?php
namespace App\Infrastructure\Dao;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Blog\NewBlog;
use \PDO;
use PDOException;

final class BlogDao
{
    const TABLE_NAME = 'blogs';
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:dbname=blog;host=mysql;charset=utf8',
                'root',
                'password'
            );
        } catch(PDOException $e) {
            exit('DB接続エラー: ' . $e->getMessage());
        }
    }

    public function create(NewBlog $blog): void
    {
        $sql = sprintf(
            'INSERT INTO %s (user_id, title, contents) VALUES (:user_id, :title, :contents)',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':user_id', $blog->user_id()->value(), PDO::PARAM_INT);
        $statement->bindValue(':title', $blog->title()->value(), PDO::PARAM_STR);
        $statement->bindValue(':contents', $blog->contents()->value(), PDO::PARAM_STR);
        $statement->execute();
    }
}
