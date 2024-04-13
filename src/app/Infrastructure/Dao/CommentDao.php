<?php
namespace App\Infrastructure\Dao;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\Comment\NewComment;
use \PDO;
use PDOException;

final class CommentDao
{
    const TABLE_NAME = 'comments';
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:dbname=blog;host=mysql;charset=utf8',
                'root',
                'password'
            );
        } catch (PDOException $e) {
            exit('DB接続エラー: ' . $e->getMessage());
        }
    }

    public function create(NewComment $comment): void
    {
        $sql = sprintf(
            'INSERT INTO %s (user_id, blog_id, commenter_name, comments) VALUES (:user_id, :blog_id, :commenter_name, :comments)',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':user_id', $comment->user_id()->value(), PDO::PARAM_INT);
        $statement->bindValue(':blog_id', $comment->blog_id()->value(), PDO::PARAM_INT);
        $statement->bindValue(':commenter_name', $comment->commenter_name()->value(), PDO::PARAM_STR);
        $statement->bindValue(':comments', $comment->comments()->value(), PDO::PARAM_STR);
        $statement->execute();
    }

    public function allComment($blogId)
    {
        $sql = sprintf(
            'SELECT * FROM comments WHERE blog_id = :id',
            self::TABLE_NAME
        );
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $blogId]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
