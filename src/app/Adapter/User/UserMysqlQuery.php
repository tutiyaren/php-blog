<?php

namespace App\Adapter\User;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\UserAgeDao;
use App\Domain\Entity\User;
use App\Domain\Entity\UserAge;
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\HashedPassword;
use App\Domain\Interface\UserQuery;
use App\Domain\ValueObject\User\Age;
use App\Domain\ValueObject\User\RegistrationDate;

class UserMySqlQuery
{
    /**
     * @var UserDao
     */
    private $userDao;
    private $userAgeDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
        $this->userAgeDao = new UserAgeDao();
    }

    public function findByEmail(Email $email)
    {
        $userMapper = $this->userDao->findByEmail($email);

        return $this->notExistsUser($userMapper)
            ? null
            : new User(
                new UserId($userMapper['id']),
                new UserName($userMapper['name']),
                new Email($userMapper['email']),
                new HashedPassword($userMapper['password']),
                new Age('20'),
                new RegistrationDate('2020-12-10 12:58:29')
            );
    }

    private function notExistsUser(?array $user): bool
    {
        return is_null($user);
    }

    public function fetchAll(int $userId): ?array
    {
        $userOld = $this->userAgeDao->fetchAll($userId);
        return $this->notExistsUser($userOld)
            ? null
            : new UserAge(
                new UserId($userOld['user_id']),
                new Age($userOld['age']),
            );
    }
}