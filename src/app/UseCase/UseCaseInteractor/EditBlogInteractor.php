<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryServise\BlogQueryServise;
use App\Adapter\Repository\BlogRepository;
use App\UseCase\UseCaseInput\EditBlogInput;
use App\UseCase\UseCaseOutput\EditBlogOutput;
use App\Domain\ValueObject\Blog\NewBlog;
use App\Domain\Entity\Blog;

final class EditBlogInteractor
{
    const COMPLETED_MESSAGE = 'ブログを編集しました';
    private $blogRepository;
    private $blogQueryServise;
    private $input;

    public function __construct(EditBlogInput $input)
    {
        $this->blogRepository = new BlogRepository();
        $this->blogQueryServise = new BlogQueryServise();
        $this->input = $input;
    }

    public function handler(): EditBlogOutput
    {
        $this->editBlog();
        return new EditBlogOutput(true, self::COMPLETED_MESSAGE);
    }

    private function editBlog(): void
    {
        $newBlog = new NewBlog(
            $this->input->id(),
            $this->input->user_id(),
            $this->input->title(),
            $this->input->contents()
        );

        $this->blogRepository->edit($newBlog);
    }
}