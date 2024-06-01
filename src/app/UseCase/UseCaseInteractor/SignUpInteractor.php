<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\UseCase\UseCaseInput\SignUpInput;
use App\Infrastructure\Dao\UserDao;
use App\Infrastructure\Dao\UserAgeDao;
use App\UseCase\UseCaseOutput\SignUpOutput;
use App\Domain\ValueObject\User\NewUser;
use App\Domain\Entity\UserAge;
use App\Domain\ValueObject\User\UserId;

/**
 * ユーザー登録ユースケース
 */
final class SignUpInteractor
{
    private $input;
    private $userDao;
    private $userAgeDao;

    public function __construct(
        SignUpInput $input,
        UserDao $userDao,
        UserAgeDao $userAgeDao
    ) {
        $this->input = $input;
        $this->userDao = $userDao;
        $this->userAgeDao = $userAgeDao;
    }

    public function handler(): SignUpOutput
    {
        $user = $this->findUser();

        if ($user !== null) {
            return new SignUpOutput(false);
        }

        $this->signup();
        return new SignUpOutput(true);
    }

    private function findUser(): ?array
    {
        return $this->userDao->findByEmail($this->input->email());
    }

    private function signup(): void
    {
        $this->userDao->create(
            new NewUser(
                $this->input->name(),
                $this->input->email(),
                $this->input->password()
            )
        );
        $user = $this->findUser();
        $this->userAgeDao->create(
            new UserAge(new UserId($user['id']), $this->input->age())
        );
    }
}
