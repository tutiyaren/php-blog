<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Repository\BlogRepository;

class GetMypageUseCase
{
    public $blogMypageRepository;

    public function __construct(BlogRepository $blogMypageRepository)
    {
        $this->blogMypageRepository = $blogMypageRepository;
    }

    public function readMypageBlog($userId)
    {
        return $this->blogMypageRepository->readMypage($userId);
    }
}
