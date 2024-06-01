<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Comment\CommentMysqlCommand;

class GetCommentUseCase
{
    public $commentMysqlCommand;

    public function __construct(CommentMysqlCommand $commentMysqlCommand)
    {
        $this->commentMysqlCommand = $commentMysqlCommand;
    }

    public function readAllComment($blogId)
    {
        return $this->commentMysqlCommand->allComment($blogId);
    }
}
