<?php declare(strict_types=1);


namespace App\Services\Setting\Handlers;


use App\Services\Setting\Repositories\SettingRepositoryCms;

class SetImageSettingValueHandler
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
     * @param array $data
     */
    public function handle(array $data)
    {
        $item = $this->repository->showByKey($data['key_name']);

        if (!empty($item['value']))
            uploader()->remove($item['value']);

        if (!empty($data['value'])) {
            $uploadAttributes = uploader()->upload($data['value']);
            $data['value'] = $uploadAttributes['path'];
        }

        $this->repository->setValue($data['value'], $item);
    }
}
