<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Repository\BlogRepository;
use App\Domain\ValueObject\Blog\ReadEditBlog;

class GetEditBlogUseCase
{
    public $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }


    public function readEditBlog($blogId)
    {
        return $this->blogRepository->readEdit($blogId);
    }
}
