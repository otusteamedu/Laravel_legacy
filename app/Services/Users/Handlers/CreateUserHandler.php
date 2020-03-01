<?php

namespace App\Services\Users\Handlers;

use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;
use Carbon\Carbon;

class CreateUserHandler {
    private $userRepository;

    public function __construct(
        EloquentUserRepository $userRepository // @ToDO: переделать красиво на UserRepositoryInterface по уроку об DI
    )
    {
        $this->userRepository = $userRepository;
    }

    public function handle(array $data): User
    {
        $data['created_at'] = Carbon::create()->subDay();
        $data['name'] = ucfirst($data['name']);
        $data['region'] = ucfirst($data['region']);
        $data['locality'] = ucfirst($data['locality']);
        $data['password'] = trim($data['password']);

        return $this->userRepository->createFromArray($data);
    }
}
