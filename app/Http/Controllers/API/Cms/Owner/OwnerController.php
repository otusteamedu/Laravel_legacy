<?php

namespace App\Http\Controllers\API\Cms\Owner;

use App\Http\Controllers\API\Cms\SubCategory\SubCategoryController;
use App\Http\Requests\FormRequest;
use App\Services\Image\CmsImageService;
use App\Services\Owner\OwnerService;
use App\Http\Controllers\API\Cms\Owner\Requests\CreateOwnerRequest;
use App\Http\Controllers\API\Cms\Owner\Requests\UpdateOwnerRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class OwnerController extends SubCategoryController
{
    /**
     * @var CmsImageService
     */
    private $imageService;

    public function __construct(
        OwnerService $service,
        CmsImageService $imageService
    )
    {
        parent::__construct($service);
        $this->imageService = $imageService;
    }

    /**
     * @param CreateOwnerRequest $request
     * @return JsonResponse
     */
    public function store(CreateOwnerRequest $request): JsonResponse {
        return Response::Json($this->service->store($request));
    }

    /**
     * @param UpdateOwnerRequest $request
     * @param int $id
     */
    public function update(UpdateOwnerRequest $request, int $id) {
        $this->service->update($request, $id);
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function upload(FormRequest $request, int $id): JsonResponse
    {
        $uploads = $this->imageService->upload($request);
        $this->service->associateWithImages($uploads, $id);

        return response()->json($this->service->getImageList($id));
    }
}
