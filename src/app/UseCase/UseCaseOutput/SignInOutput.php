<?php
namespace App\UseCase\UseCaseOutput;

final class SignInOutput
{
    private $isSuccess;

    public function __construct(bool $isSuccess)
    {
        $this->isSuccess = $isSuccess;
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }
}
