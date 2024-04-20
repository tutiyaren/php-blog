<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Domain\Entity\Comment;
use PHPUnit\Framework\TestCase;
use App\UseCase\UseCaseInput\CreateCommentInput;
use App\UseCase\UseCaseInteractor\CreateCommentInteractor;
use App\Domain\ValueObject\Comment\CommentId;
use App\Domain\ValueObject\Comment\CommentUserId;
use App\Domain\ValueObject\Comment\CommentBlogId;
use App\Domain\ValueObject\Comment\CommentCommenter_name;
use App\Domain\ValueObject\Comment\CommentComments;
use App\Domain\ValueObject\Comment\NewComment;
use App\Adapter\Comment\CommentMysqlCommand;
use App\Adapter\Comment\CommentMysqlQuery;

final class CreateCommentTest extends TestCase
{
    public function testコメント名に値が入っていて、コメント名20文字以下かつ、内容80文字以内の場合()
    {
        $input = new CreateCommentInput(
            new CommentUserId(1),
            new CommentBlogId(1),
            new CommentCommenter_name('AA'),
            new CommentComments('aaaaaaaa')
        );
        $interactor = new CreateCommentInteractor($input, new CommentMysqlQuery(), new CommentMysqlCommand());
        $this->assertSame(true, $interactor->run()->isSuccess());
    }

    public function testコメント名21文字以上の場合()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('タイトルは20文字以内でお願いします');
        $input = new CreateCommentInput(
            new CommentUserId(1),
            new CommentBlogId(1),
            new CommentCommenter_name('あいうえおあいうえおあいうえおあいうえおあ'),
            new CommentComments('aaaaaaaa')
        );
        $interactor = new CreateCommentInteractor($input, new CommentMysqlQuery(), new CommentMysqlCommand());
        $this->assertSame(false, $interactor->run()->isSuccess());
    }

    public function test内容が81文字以上の場合()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('コンテンツは80文字以内でお願いします');
        $input = new CreateCommentInput(
            new CommentUserId(1),
            new CommentBlogId(1),
            new CommentCommenter_name('AAA'),
            new CommentComments('あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあ')
        );
        $interactor = new CreateCommentInteractor($input, new CommentMysqlQuery(), new CommentMysqlCommand());
        $this->assertSame(false, $interactor->run()->isSuccess());
    }
}
