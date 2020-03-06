<?php

namespace App\Http\Controllers\API\Client\Category;


use App\Http\Controllers\API\Client\Base\ClientBaseResourceController;
use App\Http\Requests\FormRequest;
use App\Services\Category\ClientCategoryService;

class ClientCategoryController extends ClientBaseResourceController
{
    public function __construct(ClientCategoryService $service)
    {
        parent::__construct($service);
    }

    public function getImages(FormRequest $request, int $id)
    {
        return response()->json($this->service->getImages($request->all(), $id));
    }

    public function getItemWithImages(FormRequest $request, string $categoryTitle)
    {
        return response()->json($this->service->getItemWithImages($request->all(), $categoryTitle));
    }
}
