<?php
namespace App\UseCase;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Adapter\Repository\BlogRepository;
use App\Adapter\Blog\BlogMysqlCommand;

class GetMypageUseCase
{
    public $blogMysqlCommand;

    public function __construct(BlogMysqlCommand $blogMysqlCommand)
    {
        $this->blogMysqlCommand = $blogMysqlCommand;
    }

    public function readMypageBlog($userId)
    {
        return $this->blogMysqlCommand->readMypage($userId);
    }
}
