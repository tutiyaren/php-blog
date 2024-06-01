<?php
namespace App\Domain\Interface;
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Domain\Entity\User;
use PHPUnit\Framework\TestCase;
use App\UseCase\UseCaseInput\SignInInput;
use App\UseCase\UseCaseInteractor\SignInInteractor;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\InputPassword;
use App\Domain\ValueObject\HashedPassword;
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\User\NewUser;
use App\Adapter\User\UserMysqlCommand;
use App\Adapter\User\UserMysqlQuery;
use App\Domain\ValueObject\User\Age;
use App\Domain\ValueObject\User\RegistrationDate;

final class SignInTest extends TestCase
{
    public function testメールアドレスとパスワードがDBと一致している場合()
    {
        $input = new SignInInput(
            new Email('aaa@example.com'),
            new InputPassword('Aaaaaaa1')
        );
        $userMysqlQuery = new class extends UserMysqlQuery
        {
            public function findByEmail(Email $email): ?User
            {  
                $pass = 'Aaaaaaa1';
                $hashedPass = HashedPassword::hashPassword($pass);
                return new User(
                    new UserId(1),
                    new UserName('techquest'),
                    new Email('aaa@example.com'),
                    new HashedPassword($hashedPass),
                    new Age('20'),
                    new RegistrationDate('2020-12-10 12:58:29')
                );
            }
        };
        $userMysqlCommand = new class extends UserMysqlCommand
        {
            
        };
        $interactor = new SignInInteractor($input, $userMysqlQuery, $userMysqlCommand);
        $this->assertSame(true, $interactor->run()->isSuccess());
    }

    public function testメールアドレスまたはパスワードがDBと揃っていない場合()
    {
        $input = new SignInInput(
            new Email('aaa@example.com'),
            new InputPassword('Aaaaaaa1')
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
            
        };
        $interactor = new SignInInteractor($input, $userMysqlQuery, $userMysqlCommand);
        $this->assertSame(false, $interactor->run()->isSuccess());
    }
}
