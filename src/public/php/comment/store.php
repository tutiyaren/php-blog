<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Redirect\Redirect;
use App\Domain\ValueObject\Comment\CommentUserId;
use App\Domain\ValueObject\Comment\CommentBlogId;
use App\Domain\ValueObject\Comment\CommentCommenter_name;
use App\Domain\ValueObject\Comment\CommentComments;
use App\UseCase\UseCaseInput\CreateCommentInput;
use App\UseCase\UseCaseInteractor\CreateCommentInteractor;
use APp\UseCase\UseCaseOutput\CreateCommentOutput;

$commenter_name = filter_input(INPUT_POST, 'commenter_name');
$comments = filter_input(INPUT_POST, 'comments');

try {
    session_start();
    if(empty($commenter_name)) {
        throw new Exception('コメントタイトルを入力して');
    }
    $user_id = $_SESSION['user']['id'];
    $blog_id = $_SESSION['blog'];
    $commentUserId = new CommentUserId($user_id);
    $commentBlogId = new CommentBlogId($blog_id);
    $commentCommenter_name = new CommentCommenter_name($commenter_name);
    $commentComments = new CommentComments($comments);
    $useCaseInput = new CreateCommentInput($commentUserId, $commentBlogId, $commentCommenter_name, $commentComments);
    $useCase = new CreateCommentInteractor($useCaseInput);
    $useCaseOutput = $useCase->handler();

    if(!$useCaseOutput->isSuccess()) {
        throw new Exception($useCaseOutput->message());
    }
    $_SESSION['message'] = $useCaseOutput->message();
    Redirect::handler('/detail.php?id=' . $blog_id);
} catch(Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    $_SESSION['user']['commenter_name'] = $commenter_name;
    $_SESSION['user']['comments'] = $comments;
    Redirect::handler('/detail.php?id=' . $_SESSION['blog']);
}


// session_start();

// use App\Comments;
// require '../../../app/comments.php';
// $pdo = new PDO('mysql:host=mysql;dbname=blog', 'root', 'password');

// $blogId = $_SESSION['blog_id'];
// if (!(isset($_POST['commenter_name']) && isset($_POST['comments']))) {
//     header('Location: ../../../detail.php?id=' . $blogId);
//     exit();
// }

// $userId = $_SESSION['user']['id'];
// $commentTitle = $_POST['commenter_name'];
// $comment = $_POST['comments'];

// $commentModel = new Comments($pdo);


// if (empty($commentTitle) || empty($comment)) {
//     $_SESSION['errorMessage'] = 'コメント名かコメント内容の入力がありません';
//     header('Location: ../../../detail.php?id=' . $blogId);
//     exit();
// }
// $createComment = $commentModel->addComments($userId, $blogId, $commentTitle, $comment);
// if ($createComment !== false) {
//     header('Location: ../../../detail.php?id=' . $blogId);
//     exit();
// }

