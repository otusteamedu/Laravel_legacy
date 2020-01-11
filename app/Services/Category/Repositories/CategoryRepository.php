<?php


namespace App\Services\Category\Repositories;


use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    /**
     * @return Collection
     */
    public function index(): Collection {
        return Category::select(['id', 'type', 'title', 'alias'])->get();
    }

    /**
     * @param string $type
     * @return Collection
     */
    public function indexByType(string $type): Collection {
        return Category::where('type', $type)
            ->withCount('images')
            ->get();
    }

    /**
     * @param int $id
     * @return Category
     */
    public function show(int $id): Category {
        return Category::findOrFail($id);
    }

    /**
     * @param array $data
     * @return Category
     */
    public function store(array $data): Category {
        return Category::create($data);
    }

    /**
     * @param array $data
     * @param Category $category
     * @return Category
     */
    public function update(array $data, Category $category): Category {
        $category->update($data);

        return $category;
    }

    /**
     * @param Category $category
     * @return int
     * @throws \Exception
     */
    public function destroy(Category $category): int {
        return $category->delete();
    }

    /**
     * @param Category $category
     * @return Category
     */
    public function publish(Category $category): Category {
        $category->publish = !$category->publish;
        $category->save();

        return $category;
    }

    /**
     * @param Category $category
     * @return Collection
     */
    public function getImageList(Category $category): Collection {
        return $category->images()
            ->with(config('query_builder.image'))
            ->get();
    }

    /**
     * @param Category $category
     * @return Collection
     */
    public function getExcludedImageList(Category $category): Collection {
        return Image::whereDoesntHave('categories', function ($query) use ($category) {
            $query->where('id', $category->id);
        })
            ->with(config('query_builder.image'))
            ->get();
    }

    /**
     * @param Category $category
     * @param array $images
     */
    public function addImages(Category $category, array $images) {
        $category->images()->attach($images, ['category_type' => $category->type]);
    }

    /**
     * @param Category $category
     * @param int $imageId
     * @return int
     */
    public function removeImage(Category $category, int $imageId): int {
        return $category->images()->detach($imageId);
    }
}
