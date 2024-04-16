<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\UseCase\UseCaseInput\SignInInput;
use App\UseCase\UseCaseOutput\SignInOutput;
use App\Domain\ValueObject\User\NewUser;
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\HashedPassword;
use App\Domain\ValueObject\User\Age;
use App\Domain\ValueObject\User\RegistrationDate;
use Exception;
use App\Domain\Entity\User;
use App\Adapter\User\UserMysqlQuery;
use App\Adapter\User\UserMysqlCommand;

final class SignInInteractor
{
    private $input;
    private $userMysqlQuery;
    private $userMysqlCommand;

    public function __construct(
        SignInInput $input,
        UserMysqlQuery $userMysqlQuery,
        UserMysqlCommand $userMysqlCommand
    ) {
        $this->input = $input;
        $this->userMysqlCommand = $userMysqlCommand;
        $this->userMysqlQuery = $userMysqlQuery;
    }

    public function run(): SignInOutput
    {
        $user = $this->findUser();
        if ($this->existsUser($user)) {
            return new SignInOutput(false);
        }
        $userMapper = $this->createUserEntity($user);
        if ($userMapper === null) {
            throw new Exception('年齢の登録をしてください!');
        }
        if ($this->isInvalidPassword($userMapper->password())) {
            return new SignInOutput(false);
        }
        $this->saveSession($userMapper);
        return new SignInOutput(true);
    }

    private function findUser()
    {
        return $this->userMysqlQuery->findByEmail($this->input->email());
    }
    private function existsUser(?User $user): bool
    {
        return !is_null($user);
    }

    private function isInvalidPassword(HashedPassword $hashedPassword): bool
    {
        return !$hashedPassword->verify($this->input->password());
    }

    private function createUserEntity($user): ?User
    {
        $userAge = $this->userMysqlQuery->fetchAll($user['id']);
        if ($userAge === null) {
            return null;
        }
        return new User(
            new UserId($user['id']),
            new UserName($user['name']),
            new Email($user['email']),
            new HashedPassword($user['password']),
            new Age($userAge['age']),
            new RegistrationDate($user['created_at'])
        );
    }

    private function saveSession(User $user): void
    {
        session_start();
        $_SESSION['user']['id'] = $user->id()->value();
        $_SESSION['user']['name'] = $user->name()->value();
        if ($user->isPremiumMember()) {
            $_SESSION['user']['memberStatus'] = 'プレミアム会員';
        }
        if (!$user->isPremiumMember()) {
            $_SESSION['user']['memberStatus'] = 'ノーマル会員';
        }
    }
}
