<?php

namespace App\Services\Users;

use App\Models\User;
use App\Services\Users\Handlers\UserPasswordHashHandler;
use App\Services\Users\Handlers\UserUploadPhotoHandler;
use App\Services\Users\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class UserService {

    private $userRepository;
    private $userUploadPhotoHandler;
    private $userPasswordHashHandler;

    public function __construct(UserRepository $userRepository, UserUploadPhotoHandler $userUploadPhotoHandler, UserPasswordHashHandler $userPasswordHashHandler) {
        $this->userRepository = $userRepository;
        $this->userUploadPhotoHandler = $userUploadPhotoHandler;
        $this->userPasswordHashHandler = $userPasswordHashHandler;
    }

    public function findUser(int $id) {
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
     * @return User
     */
    public function storeUser(Request $request): User {
        $data = $request->all();

        $data['photo'] = $this->userUploadPhotoHandler->handle($request->file('photo'));
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
