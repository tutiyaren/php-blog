<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\User\UserId;

final class UserIdTest extends TestCase
{
    public function testユーザーIDが1以上の場合_例外が発生しないこと(): void
    {
        $actual = new UserId('1');
        $this->assertEquals('1', $actual->value());
    }

    public function testユーザーIDが1未満の場合_例外が発生すること(): void
    {
        $this->expectException(\Exception::class);
        new UserId('0');
    }
}
