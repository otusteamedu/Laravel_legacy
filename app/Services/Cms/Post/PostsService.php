<?php

namespace App\Services\Cms\Post;

use App\Http\Controllers\Cms\Post\Post\Requests\StorePostRequest;
use App\Http\Controllers\Cms\Post\Post\Requests\UpdatePostRequest;
use App\Models\Post\Post;
use App\Repositories\Post\Post\PostRepositoryInterface;
use App\Services\Image\CleanPath;
use App\Services\Image\ImageServices;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PostService
 * @package App\Services\Cms\Post
 */
class PostsService
{
    /** @var PostRepositoryInterface $postRepository */
    protected $postRepository;

    /**
     * PostService constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function paginationList(): LengthAwarePaginator
    {
        return $this->postRepository->paginationList([
                    'with' => 'rubrics',
                    'order' => ['column' => 'id', 'order' => 'asc'],
                ]);
    }

    /**
     * @param Post $post
     * @return array|null
     */
    public function getPostImage(Post $post): ?array
    {
        if ($post->image === null) {
            return null;
        }

        /** @var ImageServices $imageService */
        $imageService = app(ImageServices::class);
        $imageService->setPath(Post::IMAGE_PATH)
            ->setImage($post->image)
            ->setEntityId($post->id);
        return [
            'path' => $imageService->getPublicPath(),
            'image' => $imageService->getImageName('small'),
        ];
    }


    /**
     * @param StorePostRequest $request
     * @return string
     */
    public function store(StorePostRequest $request): string
    {
        try {
            $data = $request->getFormData();

            $post = $this->postRepository->createFromArray($data);

            if ($request->file(Post::IMAGE_FIELD)) {
                $updateData[Post::IMAGE_FIELD] = $this->uploadImage($post->id, $request);
                $this->postRepository->updateFromArray($post, $updateData);
            }

            $url = route('cms.posts.show', ['post' => $post->id]);
        } catch (\Throwable $exception) {
            $url = route('cms.posts.create');
        }
        return $url;
    }

    /**
     * @param Post $post
     * @param UpdatePostRequest $request
     * @return string
     */
    public function update(Post $post, UpdatePostRequest $request): string
    {
        try {
            $data = $request->getFormData();

            if (isset($data['icon_destroy'])) {
                $this->destroyImage($post->id);
                $data[Post::IMAGE_FIELD] = null;
            }

            if ($request->file(Post::IMAGE_FIELD)) {
                $data[Post::IMAGE_FIELD] = $this->uploadImage($post->id, $request);
            }

            $this->postRepository->updateFromArray($post, $data);

            $url = route('cms.posts.show', ['post' => $post->id]);
        } catch (\Throwable $exception) {
            $url = route('cms.posts.edit', ['post' => $post->id]);
        }
        return $url;
    }

    /**
     * @param Post $post
     * @param array $data
     * @return string
     */
    public function published(Post $post, array $data)
    {
        try {
            $this->postRepository->publishedFromArray($post, $data);
            $url = route('cms.posts.show', ['post' => $post->id]);
        } catch (\Throwable $exception) {
            $url = route('cms.posts.show', ['post' => $post->id]);
        }
        return $url;
    }

    /**
     * @param int $postId
     */
    protected function destroyImage(int $postId): void
    {
        /** @var ImageServices $imageService */
        $imageService = app(ImageServices::class);

        $imageService
            ->setPath(Post::IMAGE_PATH)
            ->setEntityId($postId);

        CleanPath::cleanPath($imageService->getEntityPath());
    }

    /**
     * @param int $postId
     * @param FormRequest $request
     * @return string
     */
    protected function uploadImage(int $postId, FormRequest $request): string
    {
        /** @var ImageServices $imageService */
        $imageService = app(ImageServices::class);

        $imageService
            ->setUploadImage($request->file(Post::IMAGE_FIELD))
            ->setPath(Post::IMAGE_PATH)
            ->setImageName($request->input('name'))
            ->setEntityId($postId);

        CleanPath::cleanPath($imageService->getEntityPath());

        $imageService->makeImage();

        return $imageService->getImageName();
    }

    /**
     * @param Post $post
     * @return string
     */
    public function destroy(Post $post): string
    {
        try {
            $this->postRepository->delete($post);
            $url = route('cms.posts.index');
        } catch (\Throwable $exception) {
            $url = route('cms.posts.show', ['post' => $post->id]);
        }
        return $url;
    }
}