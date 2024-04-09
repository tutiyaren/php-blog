<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
session_start();
ob_start();
if (!isset($_SESSION['user']['id'])) {
    Redirect::handler('user/signin.php');
    exit(); 
}

use App\Blogs;
require '../app/blogs.php';
$pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');

if(!(isset($_GET['id']) && is_numeric($_GET['id']))) {
    header('Location: mypage.php');
    exit();
}
$blogModel = new Blogs($pdo);
$blogId = $_GET['id'];

$blog = $blogModel->getBlog($blogId);

if($blog['user_id'] !== $_SESSION['id']) {
    header('Location: mypage.php');
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

        <div>
            <h1><?php echo $blog['title'] ?></h1>
        </div>

        <!-- マイ記事の詳細、表示、編集、削除、マイページへ -->
        <div>
            <div>
                <p>投稿日時:  <?php echo $blog['created_at'] ?></p>
                <p><?php echo $blog['contents'] ?></p>
            </div>
            <button><a href="edit.php?id=<?php echo $blog['id'] ?>">編集</a></button>
            <form action="php/post/delete.php" method="post"> 
                <button type="submit" name="delete">削除</button>
                <input type="hidden" name="blog_id" value="<?php echo $blog['id'] ?>">
            </form>
            <button><a href="mypage.php">マイページへ</a></button>
        </div>

    </main>
  
</body>
</html>