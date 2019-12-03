<?php
namespace App\Services\Blog\Category;

use App\Exceptions\BlogException;
use App\Models\Post\Category;
use Illuminate\Support\Str;

class CategoryService
{
    protected $categoryModel;

    public function __construct(Category $category)
    {
        $this->categoryModel = $category;
    }

    public function getCategory($filter = null)
    {
        $categories = $this->categoryModel;
        if (!is_null($filter)) {
            foreach ($filter as $field => $val) {
                $categories = $categories->where('field', 'LIKE', '%' . $val . '%');
            }
        }
        $categories = $categories->get();

        return $categories;
    }

    public function getCategoryCountBySlug(string $slug)
    {
        return $this->categoryModel->where('slug', $slug)->count();
    }

    public function getCategoryById(int $id)
    {
        $res = $this->categoryModel->where('id', $id)->first();
        if (is_null($res)) {
            throw new BlogException('Категория не найдена');
        }

        return $res;
    }

    public function getCountPostInCategory(int $categoryId)
    {
        return Category::where('id', $categoryId)->has('posts')->count();
    }

    /**
     * Генерация slug  по заголовку
     * @param string $title
     * @return string
     */
    public function generateSlug(string $title)
    {
        $slug = Str::slug(mb_strtolower($title));
        $countCategory = $this->getCategoryCountBySlug($slug);
        $i = 1;
        $newSlug = $slug;
        while ($countCategory != 0) {
            $newSlug = $slug . '_' . $i;
            $countCategory = $this->getCategoryCountBySlug($newSlug);
            $i++;
        }

        return $newSlug;
    }

    /**
     * Сохранение категории
     * @param $title
     * @param $slug
     * @return mixed
     */
    public function save($title, $slug)
    {
        $res= $this->categoryModel->create([
            'category' => $title,
            'slug' => $slug,
        ]);

        return $res;
    }

    /**
     * Обновление категории
     * @param $id
     * @param $title
     * @param $slug
     * @return mixed
     */
    public function update($id, $title, $slug)
    {
        $res = $this->categoryModel
            ->where('id', $id)
            ->update([
                'category' => $title,
                'slug' => $slug,
            ]);

        return $res;
    }

    /**
     * Удаление категории
     * @param $id
     * @throws BlogException
     */
    public function delete($id)
    {
        $postCount = $this->getCountPostInCategory($id);

        if ($postCount != 0) {
            throw new BlogException('Не возможно удалить. Есть привязанные посты');
        }

        Category::where('id', $id)->delete();
    }
}