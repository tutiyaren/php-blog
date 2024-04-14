<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Blog\BlogId;

final class BlogIdTest extends TestCase
{
    public function testブログIDが1以上である(): void
    {
        $actual = new BlogId('1');

        $this->assertEquals('1', $actual->value());
    }
}

