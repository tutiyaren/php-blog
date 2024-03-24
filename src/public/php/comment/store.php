<?php
session_start();

use App\Comments;
require '../../../app/comments.php';
$pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');

$blogId = $_SESSION['blog_id'];
if (!(isset($_POST['commenter_name']) && isset($_POST['comments']))) {
    header('Location: ../../../detail.php?id=' . $blogId);
    exit();
}

$userId = $_SESSION['id'];
$commentTitle = $_POST['commenter_name'];
$comment = $_POST['comments'];

$commentModel = new Comments($pdo);


if (empty($commentTitle) || empty($comment)) {
    $_SESSION['errorMessage'] = 'コメント名かコメント内容の入力がありません';
    header('Location: ../../../detail.php?id=' . $blogId);
    exit();
}
$createComment = $commentModel->addComments($userId, $blogId, $commentTitle, $comment);
if ($createComment !== false) {
    header('Location: ../../../detail.php?id=' . $blogId);
    exit();
}

