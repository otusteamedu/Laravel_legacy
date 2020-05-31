<?php


namespace App\Services\Blog\Author\Handlers;

use App\Models\Blog\BlogAuthor;
use App\Models\File;
use App\Services\Blog\Author\Repositories\EloquentAuthorRepository;
use App\Services\File\FileService;

class UpdateAuthorHandler
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
    public function handle(BlogAuthor $blogAuthor, array $data): BlogAuthor
    {
        if(isset($data['photo_id']) && intval($data['photo_id'])) {
            try {
                $this->fileService->deleteFileById($data['photo_id']);
            } catch (\Error $exception) {

            }
        }

        $file = $this->fileService->createFileFromRequest($data['photo'], File::USAGE_BLOG_AUTHOR_AVATAR);
        $data["photo_id"] = $file->id;

        return $this->authorRepository->updateFromArray($blogAuthor, $data);
    }

}
