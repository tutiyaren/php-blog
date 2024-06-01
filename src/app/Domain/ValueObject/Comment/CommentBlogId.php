<?php
namespace App\Domain\ValueObject\Comment;
use Exception;

final class CommentBlogId
{
    const MIN_VALUE = 1;
    const INVALID_MESSAGE = '不正な値です';

    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
