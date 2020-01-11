<?php


namespace App\Services\SubCategory;


use App\Http\Requests\FormRequest;
use App\Services\SubCategory\Repositories\SubCategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

abstract class SubCategoryService
{
    private $repository;

    public function __construct(SubCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->repository->index();
    }

    public function show(int $id)
    {
        return $this->repository->show($id);
    }

    /**
     * @param int $id
     * @return array
     */
    public function showWithImages(int $id): array
    {
        $item = $this->repository->show($id);
        $images = $this->repository->getImageList($item);

        return ['item' => $item, 'images' => $images];
    }

    /**
     * @param int $id
     * @return array
     */
    public function showWithExcludedImages(int $id): array
    {
        $item = $this->repository->show($id);
        $images = $this->repository->getExcludedImageList($item);

        return ['item' => $item, 'images' => $images];
    }

    public function store(FormRequest $request)
    {
        return $this->repository->store($request->all());
    }

    /**
     * @param FormRequest $request
     * @param int $id
     */
    public function update(FormRequest $request, int $id)
    {
        $item = $this->repository->show($id);
        $this->repository->update($request->all(), $item);
    }

    /**
     * @param int $id
     * @return int
     * @throws \Exception
     */
    public function destroy(int $id): int
    {
        $item = $this->repository->show($id);

        return $this->repository->destroy($item);
    }

    public function publish(int $id)
    {
        $item = $this->repository->show($id);

        return $this->repository->publish($item);
    }
}
