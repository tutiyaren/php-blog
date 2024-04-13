<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Adapter\Repository\BlogRepository;
use App\UseCase\GetEditBlogUseCase;
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
$blogRepository = new BlogRepository(new BlogDao($pdo));
$blogData = $blogRepository->readEdit($blogId);
$getBlogUseCase = new GetEditBlogUseCase($blogRepository);
$blog = $getBlogUseCase->readEditBlog($blogId);

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

            <div>
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        </div>

    </main>
  
</body>
</html>