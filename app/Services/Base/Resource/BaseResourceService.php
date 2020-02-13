<?php


namespace App\Services\Base\Resource;


use App\Http\Requests\FormRequest;
use App\Services\Base\Resource\Repositories\BaseResourceRepository;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseResourceService
{
    /**
     * @var BaseResourceRepository
     */
    protected $repository;

    /**
     * ResourceService constructor.
     * @param BaseResourceRepository $repository
     */
    public function __construct(BaseResourceRepository $repository)
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

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return $this->repository->show($id);
    }

    /**
     * @param FormRequest $request
     * @return mixed
     */
    public function store(FormRequest $request)
    {
        return $this->repository->store($request->all());
    }

    /**
     * @param FormRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(FormRequest $request, int $id)
    {
        $item = $this->repository->show($id);

        return $this->repository->update($request->all(), $item);
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

    /**
     * @param int $id
     * @return mixed
     */
    public function publish(int $id)
    {
        $item = $this->repository->show($id);

        return $this->repository->publish($item);
    }
}
