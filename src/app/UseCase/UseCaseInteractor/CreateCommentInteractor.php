<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\CommentQueryServise;
use App\Adapter\Repository\CommentRepository;
use App\UseCase\UseCaseInput\CreateCommentInput;
use App\UseCase\UseCaseOutput\CreateCommentOutput;
use App\Domain\ValueObject\Comment\NewComment;
use App\Domain\Entity\Comment;

final class CreateCommentInteractor
{
    const COMPLETED_MESSAGE = 'コメントを追加しました';
    private $commentRepository;
    private $commentQueryServise;
    private $input;

    public function __construct(CreateCommentInput $input)
    {
        $this->commentRepository = new CommentRepository();
        $this->commentQueryServise = new CommentQueryServise();
        $this->input = $input;
    }

    public function handler(): CreateCommentOutput
    {
        $this->createComment();
        return new CreateCommentOutput(true, self::COMPLETED_MESSAGE);
    }

    public function createComment(): void
    {
        $newComment = new NewComment(
            $this->input->user_id(),
            $this->input->blog_id(),
            $this->input->commenter_name(),
            $this->input->comments(),
        );
        $this->commentRepository->insert($newComment);
    }
}