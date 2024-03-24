<?php
namespace App;
use PDO;

abstract class AbstractComments
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}

class Comments extends AbstractComments
{
    public function getComments($blogId): array
    {
        $smt = $this->pdo->prepare('SELECT * FROM comments WHERE blog_id = :blog_id');
        $smt->execute(['blog_id' => $blogId]);
        return $smt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addComments($userId, $blogId, $commentTitle, $comments): void
{
    date_default_timezone_set('Asia/Tokyo');
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");

    $smt = $this->pdo->prepare(
        'INSERT INTO comments (user_id, blog_id, commenter_name, comments, created_at, updated_at) VALUES (:user_id, :blog_id, :commenter_name, :comments, :created_at, :updated_at)'
    );

    $smt->bindParam(':user_id', $userId);
    $smt->bindParam(':blog_id', $blogId);
    $smt->bindParam(':commenter_name', $commentTitle);
    $smt->bindParam(':comments', $comments);
    $smt->bindParam(':created_at', $created_at);
    $smt->bindParam(':updated_at', $updated_at);
    $smt->execute();
}
}