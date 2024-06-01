<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\BlogQueryServise;
use App\Adapter\Repository\BlogRepository;
use App\UseCase\UseCaseInput\CreateBlogInput;
use App\UseCase\UseCaseOutput\CreateBlogOutput;
use App\Domain\ValueObject\Blog\NewBlog;
use App\Domain\Entity\Blog;
use App\Adapter\Blog\BlogMysqlCommand;
use App\Adapter\Blog\BlogMysqlQuery;

final class CreateBlogInteractor
{
    const COMPLETED_MESSAGE = 'ブログ追加しました';
    private $input;
    private $blogMysqlCommand;
    private $blogMysqlQuery;

    public function __construct(
        CreateBlogInput $input,
        BlogMysqlQuery $blogMysqlQuery,
        BlogMysqlCommand $blogMysqlCommand
    ) {
        $this->input = $input;
        $this->blogMysqlCommand = $blogMysqlCommand;
        $this->blogMysqlQuery = $blogMysqlQuery;
    }

    public function run(): CreateBlogOutput
    {
        if(strlen($this->input->title()->value()) > 20) {
            return new CreateBlogOutput(false, 'タイトル20文字以内で');
        }
        if(strlen($this->input->contents()->value()) > 80) {
            return new CreateBlogOutput(false, '内容80文字以内で');
        }
        $this->createBlog();
        return new CreateBlogOutput(true, self::COMPLETED_MESSAGE);
    }

    private function createBlog(): void
    {
        $this->blogMysqlCommand->insert(
            new NewBlog(
                $this->input->user_id(),
                $this->input->title(),
                $this->input->contents()
            )
        );
    }
}
