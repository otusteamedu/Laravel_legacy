<?php


namespace App\Services\Mpolls;


use App\Models\Mpoll;
use App\Services\Mpolls\Handlers\CreateMpollHandler;
use App\Services\Mpolls\Handlers\DeleteMpollHandler;
use App\Services\Mpolls\Handlers\UpdateMpollHandler;
use App\Services\Mpolls\Repositories\MpollRepositoryInterface;

class MpollsService

{
    /**
     * @var MpollRepositoryInterface
     */
    private MpollRepositoryInterface $mpollRepository;
    /**
     * @var UpdateMpollHandler
     */
    private UpdateMpollHandler $updateMpollHandler;
    /**
     * @var CreateMpollHandler
     */
    private CreateMpollHandler $createMpollHandler;
    /**
     * @var DeleteMpollHandler
     */
    private DeleteMpollHandler $deleteMpollHandler;

    public function __construct(MpollRepositoryInterface $mpollRepository,
                                UpdateMpollHandler $updateMpollHandler,
                                CreateMpollHandler $createMpollHandler,
DeleteMpollHandler $deleteMpollHandler)
    {
        $this->mpollRepository = $mpollRepository;
        $this->updateMpollHandler = $updateMpollHandler;
        $this->createMpollHandler = $createMpollHandler;
        $this->deleteMpollHandler = $deleteMpollHandler;
    }

    public function search(array $mpolls)
    {
        return $this->mpollRepository->search($mpolls);
    }

    public function create(array $data)
    {
        return $this->createMpollHandler->handle($data);
    }

    public function update(Mpoll $model, array $data)
    {
        $this->updateMpollHandler->handle($model, $data);
    }

    public function destroy(Mpoll $model)
    {
        return $this->deleteMpollHandler->handler($model);
    }
}
