<?php
namespace App\Adapter\Comment;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\CommentDao;
use App\Domain\ValueObject\Comment\NewComment;

class CommentMysqlCommand
{
    private $commentDao;

    public function __construct()
    {
        $this->commentDao = new CommentDao();
    }

    public function insert(NewComment $comment): void
    {
        $this->commentDao->create($comment);
    }

    public function allComment($blogId)
    {
        return $this->commentDao->allComment($blogId);
    }
}
