<?php

namespace App\Services\Cms\User;

use App\Http\Controllers\Cms\User\User\Requests\StoreUserRequest;
use App\Http\Controllers\Cms\User\User\Requests\UpdateUserRequest;
use App\Models\User\User;
use App\Repositories\User\User\UserRepositoryInterface;
use App\Services\Image\CleanPath;
use App\Services\Image\ImageServices;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class UsersService
 * @package App\Services\Cms\User
 */
class UsersService
{
    /** @var UserRepositoryInterface $userRepository */
    protected $userRepository;

    /** @var string */
    protected $locale;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->locale = \App::getLocale();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function paginationList(): LengthAwarePaginator
    {
        return $this->userRepository->paginationList([
                 'with' => 'group',
                 'order' => ['column' => 'id', 'order' => 'asc'],
             ]);
    }

    /**
     * @param User $user
     * @return array|null
     */
    public function getUserImage(User $user): ?array
    {
        if ($user->icon === null) {
            return null;
        }

        /** @var ImageServices $imageService */
        $imageService = app(ImageServices::class);
        $imageService->setPath(User::IMAGE_PATH)
                ->setImage($user->icon)
                ->setEntityId($user->id);
        return [
            'path' => $imageService->getPublicPath(),
            'image' => $imageService->getImageName('small'),
        ];
    }

    /**
     * @param StoreUserRequest $request
     * @return string
     */
    public function store(StoreUserRequest $request): string
    {
        $data = $request->getFormData();

        try {
            $user = $this->userRepository->createFromArray($data);

            if ($request->file(User::IMAGE_FIELD)) {
                $updateData[User::IMAGE_FIELD] = $this->uploadImage($user->id, $request);
                $this->userRepository->updateFromArray($user, $updateData);
            }

            Log::info(
                __('log.info.create.user'),
                [
                    'id' => $user->id,
                    'name' => $user->name,
                    'user' => Auth::user()->id,
                ]
            );

            $url = route('cms.users.show', [
                'user' => $user->id,
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notCreate.user'),
                [
                    'exception' => $exception->getMessage(),
                    'data' => $data,
                    'user' => Auth::user()->id,
                ]
            );

            $url = route('cms.users.create', [
                'locale' => $this->locale,
            ]);
        }
        return $url;
    }

    /**
     * @param User $user
     * @param UpdateUserRequest $request
     * @return string
     */
    public function update(User $user, UpdateUserRequest $request): string
    {
        $data = $request->getFormData();

        try {
            if (isset($data['icon_destroy'])) {
                $this->destroyImage($user->id);
                $data[User::IMAGE_FIELD] = null;
            }

            if ($request->file(User::IMAGE_FIELD)) {
                $data[User::IMAGE_FIELD] = $this->uploadImage($user->id, $request);
            }

            $this->userRepository->updateFromArray($user, $data);

            Log::info(
                __('log.info.update.user'),
                [
                    'id' => $user->id,
                    'name' => $user->name,
                    'user' => Auth::user()->id,
                ]
            );

            $url = route('cms.users.show', [
                'user' => $user->id,
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notUpdate.user'),
                [
                    'exception' => $exception->getMessage(),
                    'id' => $user->id,
                    'data' => $data,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.users.edit', [
                'user' => $user->id,
                'locale' => $this->locale,
            ]);
        }
        return $url;
    }

    /**
     * @param int $userId
     */
    protected function destroyImage(int $userId): void
    {
        /** @var ImageServices $imageService */
        $imageService = app(ImageServices::class);

        $imageService
            ->setPath(User::IMAGE_PATH)
            ->setEntityId($userId);

        CleanPath::cleanPath($imageService->getEntityPath());
    }

    /**
     * @param int $userId
     * @param FormRequest $request
     * @return string
     */
    protected function uploadImage(int $userId, FormRequest $request): string
    {
        /** @var ImageServices $imageService */
        $imageService = app(ImageServices::class);

        $imageService
            ->setUploadImage($request->file(User::IMAGE_FIELD))
            ->setPath(User::IMAGE_PATH)
            ->setImageName($request->input('name'))
            ->setEntityId($userId);

        CleanPath::cleanPath($imageService->getEntityPath());

        $imageService->makeImage();

        return $imageService->getImageName();
    }

    /**
     * @param User $user
     * @return string
     */
    public function destroy(User $user): string
    {
        try {
            $this->userRepository->delete($user);
            Log::info(
                __('log.info.destroy.user'),
                [
                    'id' => $user->id,
                    'name' => $user->name,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.users.index', [
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notDestroy.user'),
                [
                    'exception' => $exception->getMessage(),
                    'data' => $user->id,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.users.show', [
                'user' => $user->id,
                'locale' => $this->locale,
            ]);
        }
        return $url;
    }
}
