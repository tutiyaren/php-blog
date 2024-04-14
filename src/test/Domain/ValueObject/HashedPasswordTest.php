<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\HashedPassword;

final class HashedPasswordTest extends TestCase
{
    public function testパスワードが正しい場合(): void
    {
        $actual = new HashedPassword('TestSmaple10');
        $this->assertSame('TestSmaple10', $actual->value());
    }
}