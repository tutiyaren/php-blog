<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\User\UserName;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\User\Age;
use App\Domain\ValueObject\InputPassword;
use App\UseCase\UseCaseInput\SignUpInput;
use App\UseCase\UseCaseInteractor\SignUpInteractor;
use App\Adapter\User\UserMysqlCommand;
use App\Adapter\User\UserMysqlQuery;

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$confirmPassword = filter_input(INPUT_POST, 'confirmPassword');
$age = filter_input(INPUT_POST, 'age');

try {
    session_start();
    if (empty($password) || empty($confirmPassword)) {
        throw new Exception('パスワードを入力してください');
    }
    if ($password !== $confirmPassword) {
        throw new Exception('パスワードが一致しません');
    }

    $userName = new UserName($name);
    $userEmail = new Email($email);
    $userPassword = new InputPassword($password);
    $userAge = new Age($age);
    $useCaseInput = new SignUpInput(
        $userName,
        $userEmail,
        $userPassword,
        $userAge
    );
    $userMysqlQuery = new UserMysqlQuery();
    $userMysqlCommand = new UserMysqlCommand();
    $useCase = new SignUpInteractor(
        $useCaseInput,
        $userMysqlQuery,
        $userMysqlCommand
    );
    $useCaseOutput = $useCase->run();

    if (!$useCaseOutput->isSuccess()) {
        throw new Exception('すでに登録済みのメールアドレスです');
    }
    $_SESSION['message'] = '登録が完了しました';
    Redirect::handler('./signin.php');
} catch (Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    $_SESSION['user']['name'] = $name;
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['age'] = $age;
    Redirect::handler('./signup.php');
}
