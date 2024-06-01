<?php
namespace App\Domain\ValueObject\Comment;
require_once __DIR__ . '/../../../../vendor/autoload.php';
use App\Domain\ValueObject\Comment\CommentUserId;
use App\Domain\ValueObject\Comment\CommentBlogId;
use App\Domain\ValueObject\Comment\CommentCommenter_name;
use App\Domain\ValueObject\Comment\CommentComments;

final class NewComment
{
    private $user_id;
    private $blog_id;
    private $commenter_name;
    private $comments;

    public function __construct(CommentUserId $user_id, CommentBlogId $blog_id, CommentCommenter_name $commenter_name, CommentComments $comments)
    {
        $this->user_id = $user_id;
        $this->blog_id = $blog_id;
        $this->commenter_name = $commenter_name;
        $this->comments = $comments;

    }

    public function user_id(): CommentUserId
    {
        return $this->user_id;
    }

    public function blog_id(): CommentBlogId
    {
        return $this->blog_id;
    }

    public function commenter_name(): CommentCommenter_name
    {
        return $this->commenter_name;
    }

    public function comments(): CommentComments
    {
        return $this->comments;
    }
}
