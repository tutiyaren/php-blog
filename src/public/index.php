<?php
session_start();
use App\Signin;
require '../app/user/signin_complete.php';
$pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');
$userModel = new Signin($pdo);

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $userModel->item($email, $password);

    $user = $userModel->getUserByEmail($email);
    $userModel->validate($user, $password);
    $error = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : "";
}
if(!(isset($_SESSION['id']))) {
    header('Location: user/signup.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: ../user/signin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blogアプリ</title>
</head>
<body>
    <?php include 'header/header.php'; ?>

    <main>
        <!-- タイトル -->
        <div>
            <h1>blog一覧</h1>
        </div>
        <!-- 絞り込み -->
        <form action="" method="get">
            <input type="text" name="" placeholder="キーワード入力">
            <button type="submit">検索</button>
        </form>
        <form action="" method="">
            <button type="submit">新しい順</button>
            <button type="submit">古い順</button>
        </form>

        <!-- 記事一覧 -->
        <div>

            <h2>タイトル</h2>
            <p>作成日時</p>
            <p>contents</p>
            <p><a href="detail.php">詳細記事へ</a></p>
            <div>--------------------------------------------------</div>

        </div>

    </main>

</body>
</html>
