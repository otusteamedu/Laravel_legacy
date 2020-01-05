<?php
/** Description of StoreUserHandler.php */
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class StoreUserHandler
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
        return $this->userRepository->store($data);
    }
}

