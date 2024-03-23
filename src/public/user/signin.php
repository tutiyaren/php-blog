<?php
session_start();
use App\Signin;
use App\Signup;
require '../../app/user/signin_complete.php';
require '../../app/user/signup_complete.php';

$pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
    $password_confirmation = htmlspecialchars($_POST['password_confirmation'], ENT_QUOTES);

    $userModel = new Signup($pdo);
    $registerUser = $userModel->createUser($name, $email, $password, $password_confirmation);
}

$success = "";
if(isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}

$error = "";
if(isset($_SESSION['errorMessage'])) {
    $error = $_SESSION['errorMessage'];
    unset($_SESSION['errorMessage']);
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

    <div>
        <div>
            <h1>ログイン</h1>
        </div>
        <div>
            <?php echo $success ?>
            <?php echo $error ?> 
        </div>

        <!-- form -->
        <form action="../index.php" method="post">
            <div>
                <input type="email" name="email" placeholder="Email">
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