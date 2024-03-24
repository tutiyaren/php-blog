<?php
session_start();

use App\Blogs;
require '../../../app/blogs.php';
$pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');

$userId = $_SESSION['id'];
$blogModel = new Blogs($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $blog_id = $_POST['blog_id'];
    $blogModel->deleteBlog($blog_id);
    header('Location: ../../../mypage.php');
    exit();
}
