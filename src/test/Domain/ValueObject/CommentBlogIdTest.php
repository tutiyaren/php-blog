<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Comment\CommentBlogId;

final class CommentBlogIdTest extends TestCase
{
    public function testコメントのブログIDが1以上であること(): void
    {
        $actual = new CommentBlogId('1');

        $this->assertEquals('1', $actual->value());
    }
}

