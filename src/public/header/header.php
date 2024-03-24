<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ob_start();

$userId = null;
$username = ""; 

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
}
if (isset($_SESSION['name'])) {
    $username = $_SESSION['name']; 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_destroy();
    header('Location: ../user/signin.php');
    exit();
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
                <list><a href="mypage.php">マイページ</a></list>
                <form action="" method="post">
                    <button type="submit">ログアウト</button>
                </form>
            </ol>
        </nav>
    </div>
</header>