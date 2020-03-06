<?php declare(strict_types=1);


namespace App\Services\Setting\Handlers;


use App\Models\Setting;
use App\Services\Setting\Repositories\CmsSettingRepository;

class GetSettingsWithTypesHandler
{
    private CmsSettingRepository $repository;

    private array $types;

    /**
     * GetTagHandler constructor.
     * @param CmsSettingRepository $repository
     */
    public function __construct(CmsSettingRepository $repository)
    {
        $this->repository = $repository;
        $this->types = Setting::TYPES;
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        $items = $this->repository->index();

        return [ 'items' => $items, 'types' => $this->types ];
    }
}
