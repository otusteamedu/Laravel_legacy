<?php

namespace App\Services\Users\Handlers;

use App\Models\User;
use App\Services\Users\Events\UserRegistered;
use App\Services\Users\Repositories\EloquentUserRepository;
use Carbon\Carbon;
use Str;

/**
 * Class CreateUserHandler
 * @package App\Services\Users\Handlers
 */
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
        $data['last_name'] = ucfirst($data['last_name']);
        $data['region'] = ucfirst($data['region']);
        $data['locality'] = ucfirst($data['locality']);
        $data['password'] = trim($data['password']);
        $data['api_token'] = Str::random(60);

        $user = $this->userRepository->createFromArray($data);

        UserRegistered::dispatch($user);

        return $user;
    }
}
