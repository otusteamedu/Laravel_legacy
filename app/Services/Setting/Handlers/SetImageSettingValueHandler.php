<?php declare(strict_types=1);


namespace App\Services\Setting\Handlers;


use App\Services\Setting\Repositories\CmsSettingRepository;

class SetImageSettingValueHandler
{
    private CmsSettingRepository $repository;

    /**
     * GetTagHandler constructor.
     * @param CmsSettingRepository $repository
     */
    public function __construct(CmsSettingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $setData
     */
    public function handle(array $setData)
    {
        $item = $this->repository->getItemByKey($setData['key_name']);

        if (!empty($item['value']))
            uploader()->remove($item['value']);

        if (!empty($setData['value'])) {
            $uploadAttributes = uploader()->upload($setData['value']);
            $setData['value'] = $uploadAttributes['path'];
        }

        $this->repository->setValue($item, $setData['value']);
    }
}
