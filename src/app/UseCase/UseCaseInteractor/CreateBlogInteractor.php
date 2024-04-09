<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\BlogQueryServise;
use App\Adapter\Repository\BlogRepository;
use App\UseCase\UseCaseInput\CreateBlogInput;
use App\UseCase\UseCaseOutput\CreateBlogOutput;
use App\Domain\ValueObject\Blog\NewBlog;
use App\Domain\Entity\Blog;

final class CreateBlogInteractor
{
    const COMPLETED_MESSAGE = 'ブログ追加しました';
    private $blogRepository;
    private $blogQueryServise;
    private $input;

    public function __construct(CreateBlogInput $input)
    {
        $this->blogRepository = new BlogRepository();
        $this->blogQueryServise = new BlogQueryServise();
        $this->input = $input;
    }

    public function handler(): CreateBlogOutput
    {
        $this->createBlog();
        return new CreateBlogOutput(true, self::COMPLETED_MESSAGE);
    }

    private function createBlog(): void
    {
        $newBlog = new NewBlog(
            $this->input->user_id(),
            $this->input->title(),
            $this->input->contents()
        );

        $this->blogRepository->insert($newBlog);
    }
}
