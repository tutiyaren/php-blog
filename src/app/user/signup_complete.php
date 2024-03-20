<?php
namespace App;
use PDO;

class Signup
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addUser(string $name, string $email, string $password): void
    {
        date_default_timezone_set('Asia/Tokyo');
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $stmt = $this->pdo->prepare(
            'INSERT INTO users(name, email, password, created_at, updated_at) VALUES (:name, :email, :password, :created_at, :updated_at)'
        );
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':updated_at', $updated_at);
        $stmt->execute();
        $_SESSION['success'] = '登録できました';
        header('Location:signin.php');
         exit(); 
    }

    public function createUser(string $name, string $email, string $password, string $password_confirmation): void
    {
        // いずれかの項目に入力が無い場合
        if (empty($name) || empty($email) || empty($password)) {
            $_SESSION['errorMessage'] =
                '「UserName」か「Email」か「Password」の入力がありません';
            header('Location:signup.php');
            exit();
        }
        // パスワードが一致しない場合
        if ($password !== $password_confirmation) {
            $_SESSION['errorPassword'] = 'パスワードが一致しません。';
            header('Location:signup.php');
            exit();
        }
        // 同一のemailがすでに保存されている場合
        if ($this->isEmail($email)) {
            $_SESSION['errorEmail'] = "すでに保存されているメールアドレスです。";
            header('Location:signup.php');
            exit(); 
        }
        $this->addUser($name, $email, $password);
    }

    public function isEmail(string $email): bool
    {
        $stmt = $this->pdo->prepare(
            'SELECT COUNT(*) FROM users WHERE email = :email'
        );
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

}




?>