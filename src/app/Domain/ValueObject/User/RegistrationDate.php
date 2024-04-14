<?php
namespace App\Domain\ValueObject\User;
use Exception;
use DateTime;

final class RegistrationDate
{
    const INVALID_MESSAGE = '登録日が不正です';
    const REGISTRATION_DATE_REGULAR_EXPRESSIONS = '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/';
    private $value;

    public function __construct(string $value)
    {
        if ($this->isInvalid($value)) {
            throw new Exception(self::INVALID_MESSAGE);
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    private function isInvalid(string $value): bool
    {
        return !preg_match(self::REGISTRATION_DATE_REGULAR_EXPRESSIONS, $value);
    }

    public function isLongTermCustomer(): bool
    {
        date_default_timezone_set('Asia/Tokyo');
        $today = new DateTime('now');
        $registrationDateAndTime = new DateTime($this->value);
        $registrationDate = new DateTime($registrationDateAndTime->format('Y-m-d'));
        $interval = $today->diff($registrationDate);
        $periodFromRegistration = $interval->format('%a');
        return $periodFromRegistration >= 30;
    }
}
