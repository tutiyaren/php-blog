<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Email;

final class EmailTest extends TestCase
{
    public function testメールアドレスの形式が正しいこと(): void
    {
        $actual = new Email('Test0!@example.com');
        $this->assertSame('Test0!@example.com', $actual->value());
    }

    public function testメールアドレスの形式が間違っている(): void
    {
        $this->expectException(\Exception::class);
        new Email('@test.jp@test.jp');
    }
}
