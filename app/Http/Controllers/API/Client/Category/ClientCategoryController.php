<?php

namespace App\Http\Controllers\API\Client\Category;


use App\Http\Controllers\API\Client\Base\ClientBaseResourceController;
use App\Services\Category\ClientCategoryService;

class ClientCategoryController extends ClientBaseResourceController
{
    public function __construct(ClientCategoryService $service)
    {
        parent::__construct($service);
    }
}
