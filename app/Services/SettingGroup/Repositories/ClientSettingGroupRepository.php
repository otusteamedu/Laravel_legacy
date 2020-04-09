<?php


namespace App\Services\SettingGroup\Repositories;


use App\Models\SettingGroup;
use App\Services\Base\Resource\Repositories\ClientBaseResourceRepository;
use App\Services\SettingGroup\Resource\SettingGroupWithSettings as SettingGroupWithSettingsResource;

class ClientSettingGroupRepository extends ClientBaseResourceRepository
{
    public function __construct(SettingGroup $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return SettingGroupWithSettingsResource::collection($this->model::has('settings')->get()->load('settings'));


    }
}
