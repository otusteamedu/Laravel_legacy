<?php


namespace App\Services\Users\Handlers;


use App\Models\User;
use App\Services\Users\Repositories\UsersRepositoryInterface;
use Carbon\Carbon;

class CreateUserHandler
{

    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;

    public function __construct(
        UsersRepositoryInterface $usersRepository
    )
    {
        $this->usersRepository = $usersRepository;
    }


    public function handle(array $data): User
    {
        $data['created_at'] = Carbon::create()->subDay();
        $data['name'] = ucfirst($data['name']);

        return $this->usersRepository->createFromArray($data);
    }
}
