<?php

namespace App\Http\Controllers\API\Client\SettingGroup;


use App\Http\Controllers\API\Client\Base\ClientBaseResourceController;
use App\Services\SettingGroup\ClientSettingGroupService;

class ClientSettingGroupController extends ClientBaseResourceController
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
