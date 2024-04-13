<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Adapter\Repository\BlogRepository;
use App\UseCase\GetDetailBlogUseCase;
use App\Infrastructure\Dao\BlogDao;
use App\Adapter\Repository\CommentRepository;
use App\UseCase\GetCommentUseCase;
use App\Infrastructure\Dao\CommentDao;
session_start();
ob_start();
if (!isset($_SESSION['user']['id'])) {
    Redirect::handler('user/signin.php');
    exit(); 
}

$blogId = $_GET['id'];
$_SESSION['blog'] = $blogId;


$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');
$blogDetailRepository = new BlogRepository(new BlogDao($pdo));
$getDetailUseCase = new GetDetailBlogUseCase($blogDetailRepository);
$blog = $getDetailUseCase->readDetailBlog($blogId);

$commentAllRepository = new CommentRepository(new CommentDao($pdo));
$getCommentUseCase = new GetCommentUseCase($commentAllRepository);
$comments = $getCommentUseCase->readAllComment($blogId);

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
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
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