<?php
namespace App;
use PDO;

class Signin
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function item($email, $password)
    {
        if (empty($email) || empty($password)) {
            $_SESSION['errorMessage'] = "メールアドレスとパスワードを入力してください";
            header('Location: user/signin.php');
            exit();
        }
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function validate($user, $password)
    {
        if (!$user || $password !== $user['password']) {
            $_SESSION['errorMessage'] = 'メールアドレスまたはパスワードが違います';
            header('Location: user/signin.php');
            exit();
        }
        $this->together($user);
    }

    public function together($user)
    {
        $_SESSION['logged_in'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        header('Location: ../index.php');
        exit();
    }
}
