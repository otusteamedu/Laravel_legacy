<?php


namespace App\Services\Mpolls\Handlers;


use App\Models\Mpoll;
use App\Services\Mpolls\Repositories\EloquentMpollRepository;

class DeleteMpollHandler
{

    /**
     * @var EloquentMpollRepository
     */
    private EloquentMpollRepository $mpollRepository;

    public function __construct(EloquentMpollRepository $mpollRepository)
    {
        $this->mpollRepository = $mpollRepository;
    }

    public function handler(Mpoll $model)
    {
        return $this->mpollRepository->destroy($model);
    }
}
