<?php
session_start();

use App\Blogs;
require '../../../app/blogs.php';
$pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');

if (!(isset($_POST['title']) && isset($_POST['contents']))) {
    header('Location: ../../../create.php');
    exit();
}

$userId = $_SESSION['id'];
$title = $_POST['title'];
$contents = $_POST['contents'];

$blogModel = new Blogs($pdo);

if (empty($title) && empty($contents)) {
    $_SESSION['errorMessage'] = 'タイトルか内容の入力がありません';
    header('Location: ../../../create.php');
    exit();
}
if ($createBlog !== false) {
    header('Location: ../../../mypage.php');
    exit();
}

$createBlog = $blogModel->addBlogs($userId, $title, $contents);
