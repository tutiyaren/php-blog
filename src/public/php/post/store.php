<?php
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\Blog\BlogUserId;
use App\Domain\ValueObject\Blog\BlogTitle;
use App\Domain\ValueObject\Blog\BlogContents;
use App\UseCase\UseCaseInput\CreateBlogInput;
use App\UseCase\UseCaseInteractor\CreateBlogInteractor;
use APp\UseCase\UseCaseOutput\CreateBlogOutput;

$title = filter_input(INPUT_POST, 'title');
$contents = filter_input(INPUT_POST, 'contents');

try {
    session_start();
    if(empty($title)) {
        throw new Exception('タイトルを入力して');
    }
    $user_id = $_SESSION['user']['id'];
    $blogUserId = new BlogUserId($user_id);
    $blogTitle = new BlogTitle($title);
    $blogContents = new BlogContents($contents);
    $useCaseInput = new CreateBlogInput($blogUserId, $blogTitle, $blogContents);
    $useCase = new CreateBlogInteractor($useCaseInput);
    $useCaseOutput = $useCase->handler();

    if(!$useCaseOutput->isSuccess()) {
        throw new Exception($useCaseOutput->message());
    }
    $_SESSION['message'] = $useCaseOutput->message();
    Redirect::handler('/index.php');
} catch(Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    $_SESSION['user']['title'] = $title;
    $_SESSION['user']['contents'] = $contents;
    Redirect::handler('/create.php');
}


// session_start();

// use App\Blogs;
// require '../../../app/blogs.php';
// $pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');

// if (!(isset($_POST['title']) && isset($_POST['contents']))) {
//     header('Location: ../../../create.php');
//     exit();
// }

// $userId = $_SESSION['id'];
// $title = $_POST['title'];
// $contents = $_POST['contents'];

// $blogModel = new Blogs($pdo);

// if (empty($title) && empty($contents)) {
//     $_SESSION['errorMessage'] = 'タイトルか内容の入力がありません';
//     header('Location: ../../../create.php');
//     exit();
// }
// $createBlog = $blogModel->addBlogs($userId, $title, $contents);

// if ($createBlog !== false) {
//     header('Location: ../../../mypage.php');
//     exit();
// }
