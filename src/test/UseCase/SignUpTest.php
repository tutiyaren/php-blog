<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Domain\Entity\User;
use PHPUnit\Framework\TestCase;
use App\UseCase\UseCaseInput\SignUpInput;
use App\UseCase\UseCaseInteractor\SignUpInteractor;
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\InputPassword;
use App\Domain\ValueObject\HashedPassword;
use App\Domain\ValueObject\User\Age;
use App\Domain\ValueObject\User\NewUser;
use App\Adapter\User\UserMysqlCommand;
use App\Adapter\User\UserMysqlQuery;
use App\Domain\ValueObject\User\RegistrationDate;

final class SignUpTest extends TestCase
{
    public function testDBに同じメールのユーザー情報が存在しない場合()
    {
        $input = new SignUpInput(
            new UserName('techquest'),
            new Email('techquest@gmail.com'),
            new InputPassword('Techquest1'),
            new Age('20'),
        );
        $userMysqlQuery = new class extends UserMysqlQuery
        {
            public function findByEmail(Email $email): ?User
            {
                return null;
            }
        };
        $userMysqlCommand = new class extends UserMysqlCommand
        {
            public function insert(NewUser $user): void
            {

            }
        };
        $interactor = new SignUpInteractor($input, $userMysqlQuery, $userMysqlCommand);
        $this->assertSame(true, $interactor->run()->isSuccess());
    }

    public function testDBに同じメールのユーザー情報が存在する場合(): void
    {
        $input = new SignUpInput(
            new UserName('techquest'),
            new Email('techquest@gmail.com'),
            new InputPassword('Techquest1'),
            new Age('20'),
        );

        $userMysqlQuery = new class extends UserMysqlQuery
        {
            public function findByEmail(Email $email): ?User
            {
                return new User(
                    new UserId(1),
                    new UserName('techquest'),
                    new Email('techquest@gmail.com'),
                    new HashedPassword('techquest1'),
                    new Age('20'),
                    new RegistrationDate('2020-12-10 12:58:29')
                );
            }
        };

        $userMysqlCommand = new class extends UserMysqlCommand
        {
            public function insert(NewUser $user): void
            {

            }
        };
        $interactor = new SignUpInteractor($input, $userMysqlQuery, $userMysqlCommand);
        $this->assertSame(false, $interactor->run()->isSuccess());
    }
}
