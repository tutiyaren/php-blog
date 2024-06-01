<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$successRegistedMessage = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

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
            <h1>ログイン</h1>
        </div>
        <div>
            <p><?php echo $successRegistedMessage; ?></p>
        </div>
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <p class="text-red-600"><?php echo $error; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- form -->
        <form action="signin_complete.php" method="post">
            <div>
                <input type="email" name="email" placeholder="Email" value="<?php if(
                    isset($_SESSION['email'])
                ) {
                    echo $_SESSION['email'];
                } ?>">
            </div>
            <div>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div>
                <button type="submit">ログイン</button>
            </div>
        </form>
        <div>
            <a href="signup.php">アカウントを作る</a>   
        </div>
    </div>
  
</body>
</html>