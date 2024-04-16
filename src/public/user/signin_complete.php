<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\InputPassword;
use App\UseCase\UseCaseInput\SignInInput;
use App\UseCase\UseCaseInteractor\SignInInteractor;
use App\Adapter\User\UserMysqlCommand;
use App\Adapter\User\UserMysqlQuery;

$email = filter_input(INPUT_POST, 'email');
$password  = filter_input(INPUT_POST, 'password');

try {
    session_start();
    if(empty($email) || empty($password)) {
        throw new Exception('パスワードとメールアドレスを入力してください');
    }
    $userEmail = new Email($email);
    $inputPassword = new InputPassword($password);
    $useCaseInput = new SignInInput($userEmail, $inputPassword);
    $userMysqlQuery = new UserMysqlQuery();
    $userMysqlCommand = new UserMysqlCommand();
    $useCase = new SignInInteractor($useCaseInput, $userMysqlQuery, $userMysqlCommand);
    $useCaseOutput = $useCase->run();

    if (!$useCaseOutput->isSuccess()) {
        throw new Exception(
            'メールアドレスまたは<br />パスワードが間違っています'
        );
    }
    Redirect::handler('../index.php');
} catch (Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    Redirect::handler('./signin.php');
}
