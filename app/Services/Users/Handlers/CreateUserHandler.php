<?php
/** Description of CreateUserHandler.php */
namespace App\Services\Users\Handlers;

use App\Models\User;
use App\Services\Users\Repositories\UserRepositoryInterface;

class CreateUserHandler
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return User
     */
    public function handle(array $data):User
    {
        // если надо, соверши какие-либо манипуляции с $data,
        // подготовь данные или
        // вызови какие-либо события
        // ...
        // Пример 1 : задание имени с большой буквы
        // $data['name'] = ucfirst($data['name'] );
        // или
        // Пример 2 : дата создания = дата вчерашнего дня
        // $data['date'] = Carbon::create()->subDay();
        // как всё будет готово,
        return $this->userRepository->create($data);
    }
}

