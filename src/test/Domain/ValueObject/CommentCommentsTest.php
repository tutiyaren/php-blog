<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Comment\CommentComments;

final class CommentCommentsTest extends TestCase
{
    public function testコメント内容が80字以内の場合(): void
    {
        $actual = new CommentComments('あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえお');

        $this->assertSame('あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえお', $actual->value());
    }

    public function testコメント内容が81以上の場合(): void
    {
        $this->expectException(\Exception::class);

        new CommentComments('あいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあいうえおあ');
    }
}

