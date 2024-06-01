<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Blog\BlogTitle;

final class BlogTitleTest extends TestCase
{
    /**
     * @test
     */
    public function testブログのタイトルが20字以内であること(): void
    {
        $actual = new BlogTitle('あいうえおあいうえおあいうえおあいうえお');

        $this->assertSame('あいうえおあいうえおあいうえおあいうえお', $actual->value());
    }

    /**
     * @test
     */
    public function testブログのタイトルが21字以上であること(): void
    {
        $this->expectException(\Exception::class);

        new BlogTitle('あいうえおあいうえおあいうえおあいうえおあ');
    }
}

