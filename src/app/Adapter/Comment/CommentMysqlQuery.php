<?php
namespace App\Adapter\Comment;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\CommentDao;

class CommentMysqlQuery
{
    private $commentDao;

    public function __construct()
    {
        $this->commentDao = new CommentDao();
    }
}
