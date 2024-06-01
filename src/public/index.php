<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\UseCase\UserCaseOutput\SignInOutput;
session_start();

if (!isset($_SESSION['user']['id'])) {
    Redirect::handler('./user/signin.php');
}

use App\Blogs;
require '../app/blogs.php';
$pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');

// ブログ一覧表示
$blogsModel = new Blogs($pdo);
$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
$orderBy = '';

if (isset($_GET['old'])) {
    $orderBy = 'old';
} 
if (isset($_GET['new'])) {
    $orderBy = 'new';
}

if (!empty($searchKeyword)) {
    $allBlogs = $blogsModel->searchBlogs($searchKeyword);
}
if(empty($searchKeyword)) {
    $allBlogs = $blogsModel->getBlogs();
}

if ($orderBy === 'old') {
    usort($allBlogs, function ($a, $b) {
        return strtotime($a['created_at']) - strtotime($b['created_at']);
    });
}
if ($orderBy === 'new') {
    usort($allBlogs, function ($a, $b) {
        return strtotime($b['created_at']) - strtotime($a['created_at']);
    });
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
        <!-- タイトル -->
        <div>
            <h1>blog一覧</h1>
        </div>
        <!-- 絞り込み -->
        <form method="get">
            <input type="text" name="search" placeholder="キーワード入力" value="<?php echo htmlspecialchars(
                $searchKeyword,
                ENT_QUOTES,
                'UTF-8'
            ); ?>">
            <button type="submit">検索</button>
            <button type="submit" name="new">新しい順</button>
            <button type="submit" name="old">古い順</button>
        </form>
        

        <!-- 記事一覧 -->
        <div>
            <?php foreach ($allBlogs as $allBlog): ?>
                <h2><?php echo $allBlog['title']; ?></h2>
                <p><?php echo $allBlog['created_at']; ?></p>
                <p><?php echo mb_strimwidth($allBlog['contents'],0,31,'…'); ?></p>
                <p><a href="detail.php?id=<?php echo $allBlog[
                    'id'
                ]; ?>">詳細記事へ</a></p>
                <div>--------------------------------------------------</div>
            <?php endforeach; ?>

        </div>

    </main>

</body>
</html>