<?php

namespace App\Services\Users;

use App\Models\User;
use App\Services\Users\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class UsersService {

    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
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
        $filePath = null;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $randString = substr(md5(microtime()), rand(0, 26), 5);
            $filePath = public_path('upload/images/' .  $randString . '/');
            $file->move($filePath, $request->file('photo')->getClientOriginalName());
            $data['photo'] = $filePath . $request->file('photo')->getClientOriginalName();
        }

        $data['password_hash'] = 123123;

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
