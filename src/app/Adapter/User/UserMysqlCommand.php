<?php

namespace App\Adapter\User;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\UserDao;
use App\Domain\ValueObject\User\NewUser;
use App\Domain\Interface\UserCommand;

class UserMySqlCommand
{
    /**
     * @var UserDao
     */
    private $userDao;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    public function insert(NewUser $user): void
    {
        $this->userDao->create($user);
    }
}
