<?php
namespace App\UseCase;

use App\Adapter\Repository\BlogRepository;

require_once __DIR__ . '/../../vendor/autoload.php';

class GetAllBlogUseCase
{
    public $blogAllRepository;

    public function __construct(BlogRepository $blogAllRepository)
    {
        $this->blogAllRepository = $blogAllRepository;
    }

    public function readAllBlog()
    {
        return $this->blogAllRepository->allBlog();
    }

    public function searchAllBlog($searchKeyword)
    {
        return $this->blogAllRepository->searchBlog($searchKeyword);
    }
}
