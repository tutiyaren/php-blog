<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\User\RegistrationDate;

final class RegistrationDateTest extends TestCase
{
    /**
     * @test
     */
    public function test登録日が正しい場合(): void
    {
        $actual = new RegistrationDate('2020-04-01 14:38:05');

        $this->assertSame('2020-04-01 14:38:05', $actual->value());
    }

    /**
     * @test
     */
    public function test登録日が不正な値な場合(): void
    {
        $this->expectException(\Exception::class);

        new RegistrationDate('2020-4-1 14:38:05');
    }
}

