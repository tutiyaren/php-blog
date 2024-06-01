<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userId = null;
$username = ""; 

if (isset($_SESSION['user']['id'])) {
    $userId = $_SESSION['user']['id'];
}
if (isset($_SESSION['user']['name'])) {
    $username = $_SESSION['user']['name']; 
}

?>

<header>
    <div style="display: flex;">
        <!-- right -->
        <div style="width: 30%;">
            <p>こんにちは！<?php echo $username ?>さん</p>
        </div>
        <!-- left -->
        <nav style="width: 70%;">
            <ol style="width: 100%; display: flex; justify-content: space-around;">
                <list><a href="index.php">ホーム</a></list>
                <list><a href="../mypage.php">マイページ</a></list>
                <a href="/user/logout.php">ログアウト</a>
            </ol>
        </nav>
    </div>
</header>