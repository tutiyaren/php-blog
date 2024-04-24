<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Comment\CommentCommenter_name;

final class CommentCommenter_nameTest extends TestCase
{
    public function testコメント名は20字以内の場合(): void
    {
        $actual = new CommentCommenter_name('あいうえおあいうえおあいうえおあいうえお');

        $this->assertSame('あいうえおあいうえおあいうえおあいうえお', $actual->value());
    }

    public function testコメント名が21字以上の場合(): void
    {
        $this->expectException(\Exception::class);

        new CommentCommenter_name('あいうえおあいうえおあいうえおあいうえおあ');
    }
}

