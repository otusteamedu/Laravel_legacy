<?php


namespace App\Services\Mpolls\Handlers;


use App\Models\Mpoll;
use App\Services\Mpolls\Repositories\EloquentMpollRepository;
use App\Services\Mpolls\Resolvers\MpollDataResolver;

class UpdateMpollHandler
{
private EloquentMpollRepository $mpollRepository;
    /**
     * @var MpollDataResolver
     */
    private MpollDataResolver $mpollDataResolver;

    public function __construct(
        EloquentMpollRepository $mpollRepository,
    MpollDataResolver $mpollDataResolver
    )
    {
        $this->mpollRepository = $mpollRepository;
        $this->mpollDataResolver = $mpollDataResolver;
    }

    public function handle(Mpoll $mpoll, $data)
    {
        $data = $this->mpollDataResolver->resolve($data);
        $this->mpollRepository->updateFromArray($mpoll, $data);
    }



}
