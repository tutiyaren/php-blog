<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Blog\BlogUserId;

final class BlogUserIdTest extends TestCase
{
    public function testブログのユーザーIDが1以上であること(): void
    {
        $actual = new BlogUserId('1');

        $this->assertEquals('1', $actual->value());
    }
}

