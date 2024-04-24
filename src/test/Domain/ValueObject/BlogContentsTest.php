<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Blog\BlogContents;

final class BlogContentsTest extends TestCase
{
    public function testコンテンツは80文字以内であること(): void
    {
        $actual = new BlogContents('あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえお');

        $this->assertSame('あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえお', $actual->value());
    }

    public function testコンテンツは81文字以上でエラー(): void
    {
        $this->expectException(\Exception::class);

        new BlogContents('あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあ');
    }
}

