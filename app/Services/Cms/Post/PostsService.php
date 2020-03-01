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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class PostService
 * @package App\Services\Cms\Post
 */
class PostsService
{
    /** @var PostRepositoryInterface $postRepository */
    protected $postRepository;

    /** @var string */
    protected $locale;

    /**
     * PostService constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->locale = \App::getLocale();
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
        $data = $request->getFormData();

        try {
            $post = $this->postRepository->createFromArray($data);

            if ($request->file(Post::IMAGE_FIELD)) {
                $updateData[Post::IMAGE_FIELD] = $this->uploadImage($post->id, $request);
                $this->postRepository->updateFromArray($post, $updateData);
            }

            Log::info(
                __('log.info.create.post'),
                [
                    'id' => $post->id,
                    'name' => $post->name,
                    'user' => Auth::user()->id,
                ]
            );

            $url = route('cms.posts.show', [
                'post' => $post->id,
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notCreate.post'),
                [
                    'exception' => $exception->getMessage(),
                    'data' => $data,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.posts.create', [
                'locale' => $this->locale,
            ]);
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
        $data = $request->getFormData();

        try {
            if (isset($data['icon_destroy'])) {
                $this->destroyImage($post->id);
                $data[Post::IMAGE_FIELD] = null;
            }

            if ($request->file(Post::IMAGE_FIELD)) {
                $data[Post::IMAGE_FIELD] = $this->uploadImage($post->id, $request);
            }

            $this->postRepository->updateFromArray($post, $data);

            Log::info(
                __('log.info.update.post'),
                [
                    'id' => $post->id,
                    'name' => $post->name,
                    'user' => Auth::user()->id,
                ]
            );

            $url = route('cms.posts.show', [
                'post' => $post->id,
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notUpdate.post'),
                [
                    'exception' => $exception->getMessage(),
                    'id' => $post->id,
                    'data' => $data,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.posts.edit', [
                'post' => $post->id,
                'locale' => $this->locale,
            ]);
        }
        return $url;
    }

    /**
     * @param Post $post
     * @param array $data
     * @return string
     */
    public function published(Post $post, array $data): string
    {
        try {
            $this->postRepository->publishedFromArray($post, $data);
            Log::info(
                __('log.info.published.post'),
                [
                    'id' => $post->id,
                    'name' => $post->name,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.posts.show', [
                'post' => $post->id,
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notPublished.post'),
                [
                    'exception' => $exception->getMessage(),
                    'id' => $post->id,
                    'data' => $data,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.posts.show', [
                'post' => $post->id,
                'locale' => $this->locale,
            ]);
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
            Log::info(
                __('log.info.destroy.post'),
                [
                    'id' => $post->id,
                    'name' => $post->name,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.posts.index', [
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notDestroy.page'),
                [
                    'exception' => $exception->getMessage(),
                    'data' => $post->id,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.posts.show', [
                'post' => $post->id,
                'locale' => $this->locale,
            ]);
        }
        return $url;
    }
}
