<?php

namespace App\Repositories;

use App\Models\Image;
use App\Http\Resources\ImageEdit as ImageEditResource;
use App\Http\Resources\Image as ImageResource;
use App\Services\Uploader;
use Validator;

class imageRepository implements CRUDRepository
{
    protected $uploader,
              $uploadModel;

    public function __construct(Uploader $uploader, Image $uploadModel)
    {
        $this->uploader = $uploader;
        $this->uploadModel = $uploadModel;
    }

    public function upload($request)
    {
        $images = $request->file('images');
        foreach($images as $image) {
            $this->uploader->validate($image, config('uploads.image_upload_rules', ''));
            $uploadedPath = $this->uploader->upload();
            if ($uploadedPath !== false) {
                $this->uploader->register($this->uploadModel);
            }
        }
    }
}
