<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\User\Age;

final class AgeTest extends TestCase
{
    /**
     * @test
     */
    public function test年齢が適正な値の場合(): void
    {
        $actual = new Age('24');

        $this->assertEquals('24', $actual->value());
    }

    /**
     * @test
     */
    public function test年齢が不正な値の場合(): void
    {
        $this->expectException(\Exception::class);

        new Age('-10');
    }
}

