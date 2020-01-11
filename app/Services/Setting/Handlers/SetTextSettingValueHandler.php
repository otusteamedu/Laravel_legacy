<?php declare(strict_types=1);


namespace App\Services\Setting\Handlers;


use App\Services\Setting\Repositories\SettingRepository;

class SetTextSettingValueHandler
{
    /**
     * @var SettingRepository
     */
    private $repository;

    /**
     * GetTagHandler constructor.
     * @param SettingRepository $repository
     */
    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     */
    public function handle(array $data)
    {
        $item = $this->repository->showByKey($data['key_name']);
        $this->repository->setValue($data['value'], $item);
    }
}
