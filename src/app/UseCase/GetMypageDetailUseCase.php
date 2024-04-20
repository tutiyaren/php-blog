<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Blog\BlogMysqlCommand;

class GetMypageDetailUseCase
{
    public $blogMysqlCommand;

    public function __construct(BlogMysqlCommand $blogMysqlCommand)
    {
        $this->blogMysqlCommand = $blogMysqlCommand;
    }

    public function readMypageDetailBlog($blogId)
    {
        return $this->blogMysqlCommand->readMypageDetail($blogId);
    }
}
