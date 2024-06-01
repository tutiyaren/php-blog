<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Comment\CommentUserId;

final class CommentUserIdTest extends TestCase
{
    public function testコメントのユーザーIDが1以上であること(): void
    {
        $actual = new CommentUserId('1');

        $this->assertEquals('1', $actual->value());
    }
}

