<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\UseCase\GetCommentUseCase;
use App\Adapter\Comment\CommentMysqlCommand;
use PHPUnit\Framework\TestResult;

final class GetCommentUseCaseTest extends TestCase
{
    public function testマイページ詳細で対象のコメント一覧を取得できる場合()
    {
        $blogId = 1;

        $interactor = new GetCommentUseCase(new CommentMysqlCommand());
        $actualCommentData = $interactor->readAllComment($blogId);

        $this->assertIsArray($actualCommentData);
        $this->assertNotEmpty($actualCommentData);
    }
}
