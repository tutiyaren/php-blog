<?php
namespace App\Domain\ValueObject\Blog;
require_once __DIR__ . '/../../../../vendor/autoload.php';
use App\Domain\ValueObject\Blog\BlogUserId;
use App\Domain\ValueObject\Blog\BlogTitle;
use App\Domain\ValueObject\Blog\BlogContents;

final class NewBlog
{
    private $user_id;
    private $title;
    private $contents;

    public function __construct(BlogUserId $user_id, BlogTitle $title, BlogContents $contents)
    {
        $this->user_id = $user_id;
        $this->title = $title;
        $this->contents = $contents;
    }

    public function user_id(): BlogUserId
    {
        return $this->user_id;
    }

    public function title(): BlogTitle
    {
        return $this->title;
    }

    public function contents(): BlogContents
    {
        return $this->contents;
    }
}
