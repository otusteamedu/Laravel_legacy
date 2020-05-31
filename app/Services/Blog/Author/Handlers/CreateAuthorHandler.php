<?php


namespace App\Services\Blog\Author\Handlers;

use App\Models\Blog\BlogAuthor;
use App\Models\File;
use App\Services\Blog\Author\Repositories\EloquentAuthorRepository;
use App\Services\File\FileService;

class CreateAuthorHandler
{
    /**
     * @var EloquentAuthorRepository
     */
    private $authorRepository;

    /**
     * @var FileService
     */
    private $fileService;

    public function __construct(
        EloquentAuthorRepository $authorRepository,
        FileService $fileService
    )
    {
        $this->authorRepository = $authorRepository;
        $this->fileService = $fileService;
    }

    /**
     * @param array $data
     * @return BlogAuthor
     */
    public function handle(array $data): BlogAuthor
    {
        $file = $this->fileService->createFileFromRequest($data['photo'], File::USAGE_BLOG_AUTHOR_AVATAR);
        $data["photo_id"] = $file->id;

        return $this->authorRepository->createFromArray($data);
    }

}
