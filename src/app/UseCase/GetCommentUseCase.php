<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Repository\CommentRepository;

class GetCommentUseCase
{
    public $commentAllRepository;

    public function __construct(CommentRepository $commentAllRepository)
    {
        $this->commentAllRepository = $commentAllRepository;
    }

    public function readAllComment($blogId)
    {
        return $this->commentAllRepository->allComment($blogId);
    }
}
