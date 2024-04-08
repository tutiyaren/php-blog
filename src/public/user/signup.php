<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$userName = $_SESSION['user']['name'] ?? '';
$email = $_SESSION['user']['email'] ?? '';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blogアプリ</title>
</head>
<body>

    <div>
        <div>
            <h1>会員登録</h1>
        </div>
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>

        <!-- form -->
        <form action="signup_complete.php" method="post">
            <div>
                <input type="text" name="name" placeholder="User name">
            </div>
            <div>
                <input type="email" name="email" placeholder="Email">
            </div>
            <div>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div>
                <input type="password" name="confirmPassword" placeholder="Password確認用">
            </div>
            <div>
                <button type="submit">アカウント作成</button>
            </div>
        </form>
        <div>
            <a href="signin.php">ログイン画面へ</a>   
        </div>
    </div>
  
</body>
</html>