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

        } catch () {
            
        }
    }

    public function create(): void
    {

    }
}
