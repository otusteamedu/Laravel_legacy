<?php declare(strict_types=1);


namespace App\Services\Setting\Handlers;


use App\Services\Setting\Repositories\CmsSettingRepository;

class GetSettingsWithTypesHandler
{
    /**
     * @var CmsSettingRepository
     */
    private $repository;

    /**
     * GetTagHandler constructor.
     * @param CmsSettingRepository $repository
     */
    public function __construct(CmsSettingRepository $repository)
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
