<?php

namespace App\Services\Users;

use App\Models\User;
use App\Services\Users\Handlers\UserPasswordHashHandler;
use App\Services\Users\Handlers\UserUploadPhotoHandler;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class UserService {

    private $userRepository;
    private $userUploadPhotoHandler;
    private $userPasswordHashHandler;

    public function __construct(UserRepositoryInterface $userRepository, UserUploadPhotoHandler $userUploadPhotoHandler, UserPasswordHashHandler $userPasswordHashHandler) {
        $this->userRepository = $userRepository;
        $this->userUploadPhotoHandler = $userUploadPhotoHandler;
        $this->userPasswordHashHandler = $userPasswordHashHandler;
    }

    public function findUser(int $id): User {
        return $this->userRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchUsers(): LengthAwarePaginator {
        return $this->userRepository->search();
    }

    /**
     * @param Request $request
     * @param bool $userData
     * @return User
     */
    public function storeUser(array $data): User {

        if($data['photo']) {
            $data['photo'] = $this->userUploadPhotoHandler->handle($data['photo']);

        }
        $data['password_hash'] = $this->userPasswordHashHandler->handle($data['password']);

        return $this->userRepository->createFromArray($data);
    }


    /**
     * @param User $user
     * @param array $data
     */
    public function updateUser(User $user, array $data) {
        $this->userRepository->updateFromArray($user, $data);
    }

    /**
     * @param array $ids
     */
    public function destroyUsers(array $ids) {
        $this->userRepository->destroy($ids);
    }
}
