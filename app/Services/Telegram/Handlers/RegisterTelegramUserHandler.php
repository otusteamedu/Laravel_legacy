<?php

namespace App\Services\Telegram\Handlers;

use App\DTOs\StudentDTO;
use App\DTOs\TelegramUserDTO;
use App\Models\TelegramUser;
use App\Services\Students\Repositories\StudentRepositoryInterface;
use App\Services\Telegram\Repositories\TelegramRepositoryInterface;

/**
 * Class CreateTelegramHandler
 * @package App\Services\Telegrams\Handlers
 */
class RegisterTelegramUserHandler extends BaseHandler
{
    /**
     * @var StudentRepositoryInterface
     */
    private $studentRepository;

    /**
     * RegisterTelegramUserHandler constructor.
     * @param TelegramRepositoryInterface $repository
     * @param StudentRepositoryInterface $studentRepository
     */
    public function __construct(TelegramRepositoryInterface $repository, StudentRepositoryInterface $studentRepository)
    {
        parent::__construct($repository);
        $this->repository = $repository;
        $this->studentRepository = $studentRepository;
    }

    /**
     * @param TelegramUser $telegramUser
     * @param $IdNumber
     * @return TelegramUser
     */
    public function handle(TelegramUser $telegramUser, $IdNumber): ?TelegramUser
    {
        if ($student = $this->studentRepository->getStudentByIdNumber(StudentDTO::fromArray([
            StudentDTO::ID_NUMBER => (int)$IdNumber,
        ]))) {
            $DTO = TelegramUserDTO::fromArray(array_merge(
                $telegramUser->toArray(),
                [TelegramUserDTO::USER_ID => $student->user->id]
            ));

            $this->repository->unsetUser($student->user_id);
            return $this->repository->update($DTO, $telegramUser);
        }

        return null;
    }
}
