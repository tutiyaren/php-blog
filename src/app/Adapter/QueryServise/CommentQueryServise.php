<?php
namespace App\Adapter\QueryServise;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\CommentDao;
use App\Domain\Entity\Comment;
use App\Domain\ValueObject\Comment\CommentId;
use App\Domain\ValueObject\Comment\CommentUserId;
use App\Domain\ValueObject\Comment\CommentBlogId;
use App\Domain\ValueObject\Comment\CommentCommenter_name;
use App\Domain\ValueObject\Comment\Comments;

final class CommentQueryServise
{
    private $commentDao;

    public function __construct()
    {
        $this->commentDao = new CommentDao();
    }
}
