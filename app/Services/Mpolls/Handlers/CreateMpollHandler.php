<?php


namespace App\Services\Mpolls\Handlers;


use App\Models\Mpoll;
use App\Services\Mpolls\Repositories\EloquentMpollRepository;
use App\Services\Mpolls\Resolvers\MpollDataResolver;

class CreateMpollHandler
{
    /**
     * @var EloquentMpollRepository
     */
    private EloquentMpollRepository $mpollRepository;
    /**
     * @var MpollDataResolver
     */
    private MpollDataResolver $mpollDataResolver;

    /**
     * CreateMpollHandler constructor.
     * @param EloquentMpollRepository $mpollRepository
     */
    public function __construct(
        EloquentMpollRepository $mpollRepository,
        MpollDataResolver $mpollDataResolver
    )
    {
        $this->mpollRepository = $mpollRepository;
        $this->mpollDataResolver = $mpollDataResolver;
    }

    public function handle(array $data): Mpoll
    {
        $data = $this->mpollDataResolver->resolve($data);
        return $this->mpollRepository->createFromArray($data);
    }

}
