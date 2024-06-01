<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Repository\BlogRepository;
use App\Domain\ValueObject\Blog\ReadEditBlog;
use App\Adapter\Blog\BlogMysqlCommand;

class GetEditBlogUseCase
{
    public $blogMysqlCommand;

    public function __construct(BlogMysqlCommand $blogMysqlCommand)
    {
        $this->blogMysqlCommand = $blogMysqlCommand;
    }


    public function readEditBlog($blogId)
    {
        return $this->blogMysqlCommand->readEdit($blogId);
    }
}
