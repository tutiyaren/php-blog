<?php
namespace App\Infrastructure\Dao;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Blog\NewBlog;
use App\Domain\ValueObject\Blog\EditBlog;
use App\Domain\ValueObject\Blog\ReadEditBlog;
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

    public function update(EditBlog $blog): void
    {
        $sql = sprintf(
            'UPDATE %s SET title = :title, contents = :contents WHERE id = :id',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $blog->id()->value(),
            ':title' => $blog->title()->value(),
            ':contents' => $blog->contents()->value(),
        ));
    }
    
    public function readEdit($blogId)
    {
        $sql = sprintf(
            'SELECT * FROM blogs WHERE id = :id',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $blogId]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    public function readMypage($userId)
    {
        $sql = sprintf(
            'SELECT * FROM blogs WHERE user_id = :id',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $userId]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readMypageDetail($blogId)
    {
        $sql = sprintf(
            'SELECT * FROM blogs WHERE id = :id',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $blogId]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function readDetail($blogId)
    {
        $sql = sprintf(
            'SELECT * FROM blogs WHERE id = :id',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $blogId]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
