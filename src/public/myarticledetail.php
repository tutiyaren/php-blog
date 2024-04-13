<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Adapter\Repository\BlogRepository;
use App\UseCase\GetMypageDetailUseCase;
use App\Infrastructure\Dao\BlogDao;
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

$userId = $_SESSION['user']['id'] ?? '';


$pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');
$blogMypageDetailRepository = new BlogRepository(new BlogDao($pdo));
$getMypageDetailUseCase = new GetMypageDetailUseCase($blogMypageDetailRepository);
$blog = $getMypageDetailUseCase->readMypageDetailBlog($blogId);

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