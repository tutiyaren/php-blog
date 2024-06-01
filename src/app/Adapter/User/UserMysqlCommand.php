<?php

namespace App\Adapter\User;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\UserAgeDao;
use App\Domain\ValueObject\User\NewUser;
use App\Domain\Entity\UserAge;

class UserMySqlCommand
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

    public function insert(NewUser $user): void
    {
        $this->userDao->create($user);
    }

    public function create(UserAge $userAge): void
    {
        $this->userAgeDao->create($userAge);
    }
}
