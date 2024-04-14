<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\InputPassword;

final class InputPasswordTest extends TestCase
{
    public function testパスワードが正しい場合(): void
    {
        $actual = new InputPassword('TestSmaple10');
        $this->assertSame('TestSmaple10', $actual->value());
    }

    public function testパスワードが8文字未満、また大文字・小文字・数字いずれかを使用していない場合(): void
    {
        $this->expectException(\Exception::class);
        new InputPassword('test');
    }
}
