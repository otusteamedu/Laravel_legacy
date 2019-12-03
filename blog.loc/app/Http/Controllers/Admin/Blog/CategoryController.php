<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Exceptions\BlogException;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Post\Category;
use App\Services\Blog\Category\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Получаем список категорий
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['pageTitle'] = 'Список категорий';
        $data['categories'] = $this->categoryService->getCategory();

        return view('admin.blog.category.index')->with($data);
    }

    /**
     * Форма создания категории
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data['pageTitle'] = 'Создание категории';

        return view('admin.blog.category.create')->with($data);
    }

    /**
     * Создание категории
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $title = $request->get('title', '');
            $slug = $this->categoryService->generateSlug($title);

            $res = $this->categoryService->save($title, $slug);

            return redirect()->route('admin.blog.categories.edit', ['id' => $res->id]);
        } catch (\Exception $e) {
            //TODO: логирование
            return redirect()->route('admin.blog.categories.index')->with('error', 'Что-то пошло не так');
        }
    }

    /**
     * Просмотр деталей категории
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $data['pageTitle'] = 'Категория';
            $data['category'] = $this->categoryService->getCategoryById($id);
            return view('admin.blog.category.edit')->with($data);
        } catch (BlogException $e) {
            return redirect()->route('admin.blog.categories.index')->with('error', $e->getMessage());
        } catch (\Exception $e) {
            //TODO: логирование
            return redirect()->route('admin.blog.categories.index')->with('error', 'Что-то пошло не так');
        }
    }

    /**
     * Форма редактирования категории
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $data['pageTitle'] = 'Категория';
            $data['category'] = $this->categoryService->getCategoryById($id);
            return view('admin.blog.category.edit')->with($data);
        } catch (BlogException $e) {
            return redirect()->route('admin.blog.categories.index')->with('error', $e->getMessage());
        } catch (\Exception $e) {
            //TODO: логирование
            return redirect()->route('admin.blog.categories.index')->with('error', 'Что-то пошло не так');
        }
    }


    public function update(StoreCategoryRequest $request, $id)
    {
        try {
            $title = $request->get('title', '');
            $currentCategory = $this->categoryService->getCategoryById($id);
            if ($currentCategory->category === $title) {
                return redirect()->back()->with('success', 'Категория изменена');
            }

            $slug = $this->categoryService->generateSlug($title);
            $res = $this->categoryService->update($id, $title, $slug);

            return redirect()->back()->with('success', 'Категория изменена');
        } catch (BlogException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            //TODO: дописать логирование
            return redirect()->back()->with('error', 'Что-то пошло не так');
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->categoryService->delete($id);
            return redirect()->back()->with('success', 'Категория удалена');
        } catch (BlogException $e){
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            //TODO: дописать логирование
            return redirect()->back()->with('error', 'Что-то пошло не так');
        }
    }
}
