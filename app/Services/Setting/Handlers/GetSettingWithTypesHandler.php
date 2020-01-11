<?php declare(strict_types=1);


namespace App\Services\Setting\Handlers;


use App\Services\Setting\Repositories\SettingRepository;

class GetSettingWithTypesHandler
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
     * @param int $id
     * @return array
     */
    public function handle(int $id): array
    {
        $item = $this->repository->show($id);
        $types = config('setting_rules.types');

        return [ 'item' => $item, 'types' => $types ];
    }
}
