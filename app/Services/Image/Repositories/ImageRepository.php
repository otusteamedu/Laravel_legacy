<?php


namespace App\Services\Image\Repositories;


use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;
use App\Services\Image\Resources\ImageDetailed as ImageDetailedResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageRepository
{
    /**
     * @return Collection
     */
    public function index(): Collection {
        return Image::with(config('query_builder.image'))->get();
    }

    /**
     * @param int $id
     * @return Image
     */
    public function show(int $id): Image {
        return Image::findOrFail($id);
    }

    /**
     * @param int $id
     * @return JsonResource
     */
    public function showForEdit(int $id): JsonResource {
        return new ImageDetailedResource(Image::findOrFail($id));
    }

    /**
     * @param string $relation
     * @param $syncData
     * @param Image $image
     */
    public function syncAssociations(string $relation, $syncData, Image $image) {
        $image->$relation()->sync($syncData);
    }

    /**
     * @param array $data
     * @param Image $image
     */
    public function fillAttributesFromArray(array $data, Image $image) {
        $image->fill($data)->save();
    }

    /**
     * @param Image $image
     * @return int
     * @throws \Exception
     */
    public function destroy(Image $image): int {
        return $image->delete();
    }

    /**
     * @param Image $image
     * @return Image
     */
    public function publish(Image $image): Image {
        $image->publish = !$image->publish;
        $image->save();

        return $image;
    }
}
