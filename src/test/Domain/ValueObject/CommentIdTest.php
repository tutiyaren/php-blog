<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Comment\CommentId;

final class CommentIdTest extends TestCase
{
    public function testコメントのIDが1以上であること(): void
    {
        $actual = new CommentId('1');
        $this->assertEquals('1', $actual->value());
    }

    public function testコメントのIDが1未満であること(): void
    {
        $this->expectException(\Exception::class);
        new CommentId('0');
    }
}

