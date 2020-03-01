<?php declare(strict_types=1);


namespace App\Services\Setting\Handlers;


use App\Services\Setting\Repositories\SettingRepositoryCms;

class GetSettingsWithTypesHandler
{
    /**
     * @var SettingRepositoryCms
     */
    private $repository;

    /**
     * GetTagHandler constructor.
     * @param SettingRepositoryCms $repository
     */
    public function __construct(SettingRepositoryCms $repository)
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
