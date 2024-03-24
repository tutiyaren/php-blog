<?php
session_start();
ob_start();
if (!isset($_SESSION['id'])) {
    header('Location: user/signin.php');
    exit(); 
}
use App\Blogs;
require '../app/blogs.php';
$pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');

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

        <!-- 記事編集欄 -->
        <div>
            <form action="php/post/update.php" method="post">
                <!-- 記事タイトル -->
                <div>
                    <label for="title">タイトル</label>
                    <input type="text" name="title" id="title" value="<?php echo $blog['title'] ?>">
                    <input type="hidden" name="blog_id" value="<?php echo $blog['id'] ?>">
                </div>
                <!-- 記事内容 -->
                <div>
                    <label for="contents">内容</label>
                    <textarea name="contents" id="contents" cols="30" rows="10"><?php echo $blog['contents'] ?></textarea>
                    <input type="hidden" name="blog_id" value="<?php echo $blog['id'] ?>">
                </div>
                <!-- 記事編集ボタン -->
                <div>
                    <button type="submit" name="update">編集</button>
                </div>
            </form>
        </div>

    </main>
  
</body>
</html>