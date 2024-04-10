<?php
namespace App\Adapter\Repository;
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Comments;
use App\Infrastructure\Dao\CommentDao;
use App\Domain\ValueObject\Comment\NewComment;

final class CommentRepository
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
}
