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
}
