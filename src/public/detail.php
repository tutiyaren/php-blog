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
use App\Comments;
require '../app/blogs.php';
require '../app/comments.php';
$pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');

if(!(isset($_GET['id']) && is_numeric($_GET['id']))) {
    return 'index.php';
}
$blogModel = new Blogs($pdo);
$blogId = $_GET['id'];
$_SESSION['blog_id'] = $blogId;


$blog = $blogModel->getBlog($blogId);

$commentModel = new Comments($pdo);
$comments = $commentModel->getComments($blogId);

$errorMessage = '';
if(isset($_SESSION['errorMessage'])) {
    $errorMessage = $_SESSION['errorMessage'];
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

    <?php include 'header/header.php'; ?>

    <main>
        <!-- 対象記事 -->
        <div>
            <div>
                <h1><?php echo $blog['title'] ?></h1>
            </div>
            <div>
                <div>
                    <p>作成日時:  <?php echo $blog['created_at'] ?></p>
                    <p><?php echo $blog['contents'] ?></p>
                </div>
                <div>
                    <a href="index.php">一覧ページへ</a>
                </div>
            </div>
        </div>

        <!-- コメント入力欄 -->
        <div>
            <div>
                <h2>この投稿にコメントしますか？</h2>
            </div>
            <div>
                <?php echo $errorMessage ?>
            </div>
            <form action="php/comment/store.php" method="post">
                <!-- コメントタイトル -->
                <div>
                    <label for="commenter_name">コメント名</label>
                    <input type="text" name="commenter_name" id="commenter_name">
                </div>
                <!-- コメント内容 -->
                <div>
                    <label for="comments">内容</label>
                    <textarea name="comments" id="comments" cols="30" rows="10"></textarea>
                </div>
                <!-- コメントボタン -->
                <div>
                    <button type="submit">コメント</button>
                </div>
            </form>
        </div>

        <!-- コメント一覧 -->
        <div>
            <div>
                <h3>コメント一覧</h3>
            </div>
            <div>
                <?PHP foreach($comments as $comment): ?>
                    <h4><?php echo $comment['commenter_name'] ?></h4>
                    <p><?php echo $comment['comments'] ?></p>
                    <p><?php echo $comment['created_at'] ?></p>
                    <div>---------------------------------------------</div>
                <?php endforeach; ?>
            </div>
        </div>

    </main>
  
</body>
</html>