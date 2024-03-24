<?php
session_start();
ob_start();

use App\Blogs;
require '../../../app/blogs.php';
$pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');

if (!(isset($_POST['title']) && isset($_POST['contents']))) {
    header('Location: ../../../mypage.php');
    exit();
}

$userId = $_SESSION['id'];
$title = $_POST['title'];
$contents = $_POST['contents'];

$blogModel = new Blogs($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $blog_id = $_POST['blog_id'];
    $blogModel->updateBlog($blog_id, $title, $contents);
    header('Location: ../../../myarticledetail.php?id=' . $blog_id);
    exit();
}
