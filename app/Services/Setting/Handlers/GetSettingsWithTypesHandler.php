<?php declare(strict_types=1);


namespace App\Services\Setting\Handlers;


use App\Services\Setting\Repositories\SettingRepository;

class GetSettingsWithTypesHandler
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
     * @return array
     */
    public function handle(): array
    {
        $items = $this->repository->index();
        $types = config('setting_rules.types');

        return [ 'items' => $items, 'types' => $types ];
    }
}
