<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\Blog\BlogId;
use App\Domain\ValueObject\Blog\BlogUserId;
use App\Domain\ValueObject\Blog\BlogTitle;
use App\Domain\ValueObject\Blog\BlogContents;
use App\UseCase\UseCaseInput\EditBlogInput;
use App\UseCase\UseCaseInteractor\EditBlogInteractor;
use APp\UseCase\UseCaseOutput\EditBlogOutput;

$blog_id = filter_input(INPUT_POST, 'blog_id');
$title = filter_input(INPUT_POST, 'title');
$contents = filter_input(INPUT_POST, 'contents');

try {
    session_start();
    if(empty($title)) {
        throw new Exception('タイトルを入力して');
    }
    $user_id = $_SESSION['user']['id'];
    $blogUserId = new BlogUserId($user_id);
    $id = new BlogId($blog_id);
    $blogTitle = new BlogTitle($title);
    $blogContents = new BlogContents($contents);
    $useCaseInput = new EditBlogInput($id, $blogUserId, $blogTitle, $blogContents);
    $useCase = new EditBlogInteractor($useCaseInput);
    $useCaseOutput = $useCase->handler();

    if(!$useCaseOutput->isSuccess()) {
        throw new Exception($useCaseOutput->message());
    }
    $_SESSION['message'] = $useCaseOutput->message();
    Redirect::handler('/myarticledetail.php?id=' . $blog_id);
} catch(Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    $_SESSION['user']['title'] = $title;
    $_SESSION['user']['contents'] = $contents;
    Redirect::handler('/edit.php?id=' . $_SESSION['blog']);
}





// session_start();
// ob_start();

// use App\Blogs;
// require '../../../app/blogs.php';
// $pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');

// if (!(isset($_POST['title']) && isset($_POST['contents']))) {
//     header('Location: ../../../mypage.php');
//     exit();
// }

// $userId = $_SESSION['id'];
// $title = $_POST['title'];
// $contents = $_POST['contents'];

// $blogModel = new Blogs($pdo);

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
//     $blog_id = $_POST['blog_id'];
//     $blogModel->updateBlog($blog_id, $title, $contents);
//     header('Location: ../../../myarticledetail.php?id=' . $blog_id);
//     exit();
// }
