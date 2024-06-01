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

$blogModel = new Blogs($pdo);

$userId = $_SESSION['user']['id'];
$myArticles = $blogModel->getMyBlogs($userId);

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
            <h1>マイページ</h1>
        </div>

        <!-- 新規作成ボタン -->
        <div>
            <p><a href="create.php">新規作成</a></p>
        </div>

        <!-- マイ記事一覧 -->
        <div>
            <?php foreach($myArticles as $myArticle): ?>
                <h2><?php echo $myArticle['title'] ?></h2>
                <p><?php echo $myArticle['created_at'] ?></p>
                <p><?php echo mb_strimwidth($myArticle['contents'], 0, 31, '…') ?></p>
                <p><a href="myarticledetail.php?id=<?php echo $myArticle['id'] ?>">マイ詳細記事へ</a></p>
                <div>--------------------------------------------------</div>
            <?php endforeach; ?>
        </div>


    </main>
  
</body>
</html>