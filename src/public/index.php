<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Adapter\Repository\BlogRepository;
use App\UseCase\GetAllBlogUseCase;
use App\Infrastructure\Dao\BlogDao;
use App\Adapter\Blog\BlogMysqlCommand;
session_start();
if (!isset($_SESSION['user']['id'])) {
    Redirect::handler('./user/signin.php');
}
$memberStatus = $_SESSION['user']['memberStatus'];

$searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
$orderBy = '';
if (isset($_GET['old'])) {
    $orderBy = 'old';
} 
if (isset($_GET['new'])) {
    $orderBy = 'new';
}


$pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');
$blogAllRepository = new BlogMysqlCommand(new BlogDao($pdo));
$getAllUseCase = new GetAllBlogUseCase($blogAllRepository);

if (!empty($searchKeyword)) {
    $allBlogs = $getAllUseCase->searchAllBlog($searchKeyword);
}
if(empty($searchKeyword)) {
    $allBlogs = $getAllUseCase->readAllBlog();
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
  <link rel="stylesheet" href="./css/modal.css">
  <link rel="stylesheet" href="./css/click.css">
</head>
<body>
    <?php include 'header/header.php'; ?>

    <main>
        <!-- タイトル -->
        <p class="member-status" id="memberCondition"><?php echo $memberStatus; ?></p>

        <div class="modal-overlay" id="memberOverlay">
            <div class="modal">
                <dialog class="member" id="openCondition">
                    <p class="member-title">会員ランクの条件</p>
                    <p class="member-inner">
                        <span class="member-text">18歳以上であること</span>
                        <span class="member-text">会員登録してから30日以上経過していること</span>
                    </p>
                    <button class="close-button" id="closeButton">閉じる</button>
                </dialog>
            </div>
        </div>

        
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
            <button type="submit" id="search" class="search">検索</button>
            <button type="submit" id="newSort" name="new" class="newSort">新しい順</button>
            <button type="submit" id="oldSort" name="old" class="oldSort">古い順</button>
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

    <script src="./js/modal.js"></script>
    <script src="./js/click.js"></script>

</body>
</html>