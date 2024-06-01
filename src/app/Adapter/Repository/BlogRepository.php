<?php
namespace App\Adapter\Repository;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\BlogDao;
use App\Domain\ValueObject\Blog\NewBlog;

final class BlogRepository
{
    private $blogDao;

    public function __construct()
    {
        $this->blogDao = new BlogDao();
    }

    public function insert(NewBlog $blog): void
    {
        $this->blogDao->create($blog);
    }

    public function edit(NewBlog $blog): void
    {
        $this->blogDao->update($blog);
    }
}
