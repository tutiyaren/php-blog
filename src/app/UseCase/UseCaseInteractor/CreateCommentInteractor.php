<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\CommentQueryServise;
use App\Adapter\Repository\CommentRepository;
use App\UseCase\UseCaseInput\CreateCommentInput;
use App\UseCase\UseCaseOutput\CreateCommentOutput;
use App\Domain\ValueObject\Comment\NewComment;
use App\Domain\Entity\Comment;
use App\Adapter\Comment\CommentMysqlCommand;
use App\Adapter\Comment\CommentMysqlQuery;

final class CreateCommentInteractor
{
    const COMPLETED_MESSAGE = 'コメントを追加しました';
    private $input;
    private $commentMysqlCommand;
    private $commentMysqlQuery;

    public function __construct(
        CreateCommentInput $input,
        CommentMysqlQuery $commentMysqlQuery,
        CommentMysqlCommand $commentMysqlCommand
    ) {
        $this->input = $input;
        $this->commentMysqlCommand = new CommentMysqlCommand();
        $this->commentMysqlQuery = new CommentMysqlQuery();
    }

    public function run(): CreateCommentOutput
    {
        if(strlen($this->input->commenter_name()->value()) > 20) {
            return new CreateCommentOutput(false, 'タイトル20文字以内で');
        }
        if(strlen($this->input->comments()->value()) > 80) {
            return new CreateCommentOutput(false, '内容80文字以内で');
        }
        $this->createComment();
        return new CreateCommentOutput(true, self::COMPLETED_MESSAGE);
    }

    public function createComment(): void
    {
        $this->commentMysqlCommand->insert(
            new NewComment(
                $this->input->user_id(),
                $this->input->blog_id(),
                $this->input->commenter_name(),
                $this->input->comments(),
            )
        );
    }
}