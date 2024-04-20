<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Domain\Entity\Blog;
use PHPUnit\Framework\TestCase;
use App\UseCase\UseCaseInput\CreateBlogInput;
use App\UseCase\UseCaseInteractor\CreateBlogInteractor;
use App\Domain\ValueObject\Blog\BlogId;
use App\Domain\ValueObject\Blog\BlogUserId;
use App\Domain\ValueObject\Blog\BlogTitle;
use App\Domain\ValueObject\Blog\BlogContents;
use App\Domain\ValueObject\Blog\NewBlog;
use App\Adapter\Blog\BlogMysqlCommand;
use App\Adapter\Blog\BlogMysqlQuery;

final class CreateBlogTest extends TestCase
{
    public function testタイトルに値が入っていて、タイトル20文字以下かつ、内容80文字以内の場合()
    {
        $input = new CreateBlogInput(
            new BlogUserId(1),
            new BlogTitle('AAA'),
            new BlogContents('aaaaaaaaa')
        );
        $interactor = new CreateBlogInteractor($input, new BlogMysqlQuery(), new BlogMysqlCommand());
        $this->assertSame(true, $interactor->run()->isSuccess());
    }

    public function testタイトル21文字以上の場合()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('タイトルは20文字以内でお願いします');

        $input = new CreateBlogInput(
            new BlogUserId(1),
            new BlogTitle('あいうえおあいうえおあいうえおあいうえおあ'),
            new BlogContents('aaaaaaaaa')
        );
        $interactor = new CreateBlogInteractor($input, new BlogMysqlQuery(), new BlogMysqlCommand());
        $this->assertSame(false, $interactor->run()->isSuccess());
    }

    public function test内容が81文字以上の場合()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('コンテンツは80文字以内でお願いします');
        $input = new CreateBlogInput(
            new BlogUserId(1),
            new BlogTitle('AAA'),
            new BlogContents('あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあ')
        );
        $interactor = new CreateBlogInteractor($input, new BlogMysqlQuery(), new BlogMysqlCommand());
        $this->assertSame(false, $interactor->run()->isSuccess());
    }
}

