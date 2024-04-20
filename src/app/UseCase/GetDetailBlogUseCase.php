<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Blog\BlogMysqlCommand;

class GetDetailBlogUseCase
{
    public $blogMysqlCommand;

    public function __construct(BlogMysqlCommand $blogMysqlCommand)
    {
        $this->blogMysqlCommand = $blogMysqlCommand;
    }

    public function readDetailBlog($blogId)
    {
        return $this->blogMysqlCommand->readDetail($blogId);
    }
}
