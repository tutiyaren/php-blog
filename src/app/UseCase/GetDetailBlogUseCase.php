<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Repository\BlogRepository;

class GetDetailBlogUseCase
{
    public $blogDetailRepository;

    public function __construct(BlogRepository $blogDetailRepository)
    {
        $this->blogDetailRepository = $blogDetailRepository;
    }

    public function readDetailBlog($blogId)
    {
        return $this->blogDetailRepository->readDetail($blogId);
    }
}
