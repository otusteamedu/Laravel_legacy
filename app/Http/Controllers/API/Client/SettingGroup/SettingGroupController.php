<?php

namespace App\Http\Controllers\API\Client\SettingGroup;


use App\Http\Controllers\API\Client\Base\BaseResourceController;
use App\Services\SettingGroup\ClientSettingGroupService;

class SettingGroupController extends BaseResourceController
{
    /**
     * ClientSettingGroupController constructor.
     * @param ClientSettingGroupService $service
     */
    public function __construct(ClientSettingGroupService $service)
    {
        parent::__construct($service);
    }
}
