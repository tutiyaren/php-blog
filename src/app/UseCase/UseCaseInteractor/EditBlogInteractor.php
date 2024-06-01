<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\BlogQueryServise;
use App\Adapter\Repository\BlogRepository;
use App\UseCase\UseCaseInput\EditBlogInput;
use App\UseCase\UseCaseOutput\EditBlogOutput;
use App\Domain\ValueObject\Blog\EditBlog;
use App\Domain\Entity\Blog;
use App\Adapter\Blog\BlogMysqlCommand;
use App\Adapter\Blog\BlogMysqlQuery;

final class EditBlogInteractor
{
    const COMPLETED_MESSAGE = 'ブログを編集しました';
    private $input;
    private $blogMysqlCommand;
    private $blogMysqlQuery;

    public function __construct(
        EditBlogInput $input,
        BlogMysqlQuery $blogMysqlQuery,
        BlogMysqlCommand $blogMysqlCommand
    ) {
        $this->input = $input;
        $this->blogMysqlCommand = $blogMysqlCommand;
        $this->blogMysqlQuery = $blogMysqlQuery;
    }

    public function run(): EditBlogOutput
    {
        if(strlen($this->input->title()->value()) > 20) {
            return new EditBlogOutput(false, 'タイトル20文字以内で');
        }
        if(strlen($this->input->contents()->value()) > 80) {
            return new EditBlogOutput(false, '内容80文字以内で');
        }
        $this->editBlog();
        return new EditBlogOutput(true, self::COMPLETED_MESSAGE);
    }

    private function editBlog(): void
    {
        $this->blogMysqlCommand->edit(
            new EditBlog(
                $this->input->id(),
                $this->input->user_id(),
                $this->input->title(),
                $this->input->contents()
            )
        );
    }
}