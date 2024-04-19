<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\UseCase\UseCaseInput\SignUpInput;
use App\UseCase\UseCaseOutput\SignUpOutput;
use App\Domain\ValueObject\User\NewUser;
use App\Domain\Entity\User;
use App\Adapter\User\UserMySqlQuery;
use App\Adapter\User\UserMySqlCommand;
use App\Domain\Entity\UserAge;
use App\Domain\ValueObject\User\UserId;

/**
 * ユーザー登録ユースケース
 */
final class SignUpInteractor
{
    private $input;
    private $userMysqlCommand;
    private $userMysqlQuery;

    public function __construct(
        SignUpInput $input,
        UserMysqlQuery $userMysqlQuery,
        UserMysqlCommand $userMysqlCommand
    ) {
        $this->userMysqlCommand = $userMysqlCommand;
        $this->userMysqlQuery = $userMysqlQuery;
        $this->input = $input;
    }

    public function run(): SignUpOutput
    {
        $user = $this->findUser();

        if ($this->existsUser($user)) {
            return new SignUpOutput(false);
        }

        $this->signup();
        return new SignUpOutput(true);
    }

    private function findUser(): ?User
    {
        return $this->userMysqlQuery->findByEmail($this->input->email());
    }

    private function existsUser(?User $user): bool
    {
        return !is_null($user);
    }

    private function signup(): void
    {
        $this->userMysqlCommand->insert(
            new NewUser(
                $this->input->name(),
                $this->input->email(),
                $this->input->password()
            )
        );

        $user = $this->findUser();
        $userId = $user->id()->value();
        $this->userMysqlCommand->create(
            new UserAge(
                new UserId($userId),
                $this->input->age()
            )
        );
    }
}
