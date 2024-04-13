<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Repository\BlogRepository;

class GetMypageDetailUseCase
{
    public $mypageDetailRepository;

    public function __construct(BlogRepository $mypageDetailRepository)
    {
        $this->mypageDetailRepository = $mypageDetailRepository;
    }

    public function readMypageDetailBlog($blogId)
    {
        return $this->mypageDetailRepository->readMypageDetail($blogId);
    }
}
