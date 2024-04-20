<?php

namespace App\Adapter\Blog;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\BlogDao;
use App\Domain\Entity\Blog;
use App\Domain\ValueObject\Blog\BlogId;
use App\Domain\ValueObject\Blog\BlogUserId;
use App\Domain\ValueObject\Blog\BlogTitle;
use App\Domain\ValueObject\Blog\BlogContents;

class BlogMysqlQuery
{
    private $blogDao;

    public function __construct()
    {
        $this->blogDao = new BlogDao();
    }

    
}
