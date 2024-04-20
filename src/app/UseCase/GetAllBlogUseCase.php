<?php
namespace App\UseCase;

use App\Adapter\Blog\BlogMysqlCommand;

require_once __DIR__ . '/../../vendor/autoload.php';

class GetAllBlogUseCase
{
    public $blogAllCommand;

    public function __construct(BlogMysqlCommand $blogAllCommand)
    {
        $this->blogAllCommand = $blogAllCommand;
    }

    public function readAllBlog()
    {
        return $this->blogAllCommand->allBlog();
    }

    public function searchAllBlog($searchKeyword)
    {
        return $this->blogAllCommand->searchBlog($searchKeyword);
    }
}
