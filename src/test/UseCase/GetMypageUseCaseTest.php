<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\UseCase\GetMypageUseCase;
use App\Adapter\Blog\BlogMysqlCommand;

final class GetMypageUseCaseTest extends TestCase
{
    public function testマイページでユーザーの対象データを取得できる場合()
    {
        $userId = 1;

        $interactor = new GetMypageUseCase(new BlogMysqlCommand());
        $actualBlogData = $interactor->readMypageBlog($userId);

        $this->assertIsArray($actualBlogData);
        $this->assertNotEmpty($actualBlogData);
    }
}
