<?php


namespace App\Services\Blog\Author\Handlers;


use App\Models\Blog\BlogAuthor;
use App\Models\File;
use App\Services\Blog\Author\Repositories\EloquentAuthorRepository;
use App\Services\File\FilePathHelper;
use App\Services\File\FileService;

class DeleteAuthorHandler
{
    /**
     * @var EloquentAuthorRepository
     */
    private $authorRepository;

    /**
     * @var FileService
     */
    private $fileService;

    /**
     * UpdateAuthorHandler constructor.
     * @param EloquentAuthorRepository $authorRepository
     * @param FileService $fileService
     */
    public function __construct(
        EloquentAuthorRepository $authorRepository,
        FileService $fileService
    )
    {
        $this->authorRepository = $authorRepository;
        $this->fileService = $fileService;
    }

    /**
     * @param BlogAuthor $blogAuthor
     * @param array $data
     * @return BlogAuthor
     */
    public function handle(BlogAuthor $blogAuthor)
    {
        $photo = $blogAuthor->photo()->get()->first();
        if($photo) {
            $this->fileService->deleteFileById($photo->id);
        }
        $blogAuthor->delete();
    }
}
