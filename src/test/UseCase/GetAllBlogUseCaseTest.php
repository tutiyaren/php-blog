<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\UseCase\GetAllBlogUseCase;
use App\Adapter\Blog\BlogMysqlCommand;

final class GetAllBlogUseCaseTest extends TestCase
{
    public function testトップページですべてのデータを取得できる場合()
    {
        $blogMysqlCommand = new class extends BlogMysqlCommand
        {
            
        };

        $interactor = new GetAllBlogUseCase($blogMysqlCommand);
        $actualBlogData = $interactor->readAllBlog();

        $this->assertIsArray($actualBlogData);
        $this->assertNotEmpty($actualBlogData);
    }

    public function testトップページで検索したデータを取得できる場合()
    {
        $searchKeyword = 'A';
        $blogMysqlCommand = new class extends BlogMysqlCommand
        {
            
        };

        $interactor = new GetAllBlogUseCase($blogMysqlCommand);
        $actualBlogData = $interactor->searchAllBlog($searchKeyword);

        $this->assertIsArray($actualBlogData);
        $this->assertNotEmpty($actualBlogData);
    }
}
