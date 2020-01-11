<?php


namespace App\Services\Category\Handlers;


use App\Models\Category;
use App\Models\Image;

class UploadImagesToCategoryHandler
{
    /**
     * @var Image
     */
    private $uploadModel;

    /**
     * UploadImagesToCategoryHandler constructor.
     * @param Image $uploadModel
     */
    public function __construct(Image $uploadModel)
    {
        $this->uploadModel = $uploadModel;
    }

    /**
     * @param array $uploadImages
     * @param Category $category
     * @return Category
     */
    public function handle(array $uploadImages, Category $category): Category
    {
        $images = array_map(function ($image) {
            $image = uploader()->store($image, $this->uploadModel);
            return $image->id;
        }, $uploadImages);

        $category->images()->attach($images, ['category_type' => $category->type]);

        return $category;
    }
}
