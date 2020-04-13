<?php


namespace App\Services\Mpolls;


use App\Services\Mpolls\Repositories\MpollRepositoryInterface;

class MpollsService

{
    private MpollRepositoryInterface $mpollRepository;

    public function __construct(MpollRepositoryInterface $mpollRepository)
    {
        $this->mpollRepository = $mpollRepository;
    }

    public function search(array $mpolls)
    {
        return $this->mpollRepository->search($mpolls);
    }
}
