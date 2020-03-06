<?php

namespace App\Http\Controllers\API\Cms\Tag;

use App\Http\Controllers\API\Cms\SubCategory\SubCategoryController;
use App\Services\Tag\TagService;
use App\Http\Controllers\API\Cms\Tag\Requests\CreateTagRequest;
use App\Http\Controllers\API\Cms\Tag\Requests\UpdateTagRequest;
use Illuminate\Http\JsonResponse;

class TagController extends SubCategoryController
{
    public function __construct(TagService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param CreateTagRequest $request
     * @return JsonResponse
     */
    public function store(CreateTagRequest $request): JsonResponse
    {
        return response()->json($this->service->store($request->all()));
    }

    /**
     * @param UpdateTagRequest $request
     * @param int $id
     */
    public function update(UpdateTagRequest $request, int $id)
    {
        $this->service->update($id, $request->all());
    }
}
