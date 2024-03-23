<?php
namespace App;
use PDO;

abstract class AbstractBlogs
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}

class Blogs extends AbstractBlogs
{
    public function getBlogs(): array
    {
        $smt = $this->pdo->query('SELECT * FROM blogs');
        return $smt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBlog($blogId): array
    {
        $smt = $this->pdo->prepare('SELECT * FROM blogs WHERE id = :id');
        $smt->execute(['id' => $blogId]);
        $blog = $smt->fetch(PDO::FETCH_ASSOC);
        return $blog;
    }

    public function getMyBlogs($userId): array
    {
        $smt = $this->pdo->prepare(
            'SELECT * FROM blogs WHERE user_id = :user_id'
        );
        $smt->execute(['user_id' => $userId]);
        $userId = $smt->fetchAll(PDO::FETCH_ASSOC);
        return $userId;
    }

    public function addBlogs($userId, $title, $contents): void
    {
        date_default_timezone_set('Asia/Tokyo');
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");

        $smt = $this->pdo->prepare(
            'INSERT INTO blogs(user_id, title, contents, created_at, updated_at) VALUES (:user_id, :title, :contents, :created_at, :updated_at)'
        );

        $smt->bindParam(':user_id', $userId);
        $smt->bindParam(':title', $title);
        $smt->bindParam(':contents', $contents);
        $smt->bindParam(':created_at', $created_at);
        $smt->bindParam(':updated_at', $updated_at);
        $smt->execute();
    }

    public function updateBlog($blog_id, $title, $contents)
    {
        $smt = $this->pdo->prepare('UPDATE blogs SET title = :title, contents = :contents WHERE id = :id');
        $smt->execute(array(
            ':id' =>$blog_id,
            ':title' =>$title,
            ':contents' =>$contents
        ));
    }

    public function deleteBlog($blog_id) {
        $smt = $this->pdo->prepare('DELETE FROM blogs WHERE id = :id');
        $smt->execute(array(':id' => $blog_id));
    }
}
