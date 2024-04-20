<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\UseCase\GetDetailBlogUseCase;
use App\Adapter\Blog\BlogMysqlCommand;

final class GetDetailBlogUseCaseTest extends TestCase
{
    public function testマイページ詳細ページで対象のデータを取得できる場合()
    {
        $blogId = 1;
        $expectedBlogData = [
            'id' => 1,
            'user_id' => 1,
            'title' => 'AAAaaa',
            'contents' => 'aaaaaaaaaAA',
            'created_at' => '2024-04-18 21:37:35',
            'updated_at' => '2024-04-20 13:50:46'
        ];

        $interactor = new GetDetailBlogUseCase(new BlogMysqlCommand());
        $actualBlogData = $interactor->readDetailBlog($blogId);
        $this->assertEquals($expectedBlogData, $actualBlogData);
    }
}