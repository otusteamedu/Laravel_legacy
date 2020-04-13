<?php


namespace App\Services\Filters\Handlers;


use App\Models\Filter;
use App\Services\Filters\Repositories\FilterRepositoryInterface;
use App\Services\Filters\Resolvers\FilterAdditionalSataResolver;

class CreateFilterHandler
{
    private FilterRepositoryInterface $filterRepository;
    private FilterAdditionalSataResolver $resolver;

    public function __construct(
        FilterRepositoryInterface $filterRepository,
        FilterAdditionalSataResolver $resolver
    )
    {
        $this->filterRepository = $filterRepository;
        $this->resolver = $resolver;
    }

    public function handle(array $data): Filter
    {
        //Just for practise
        $data = $this->resolver->resolve($data);
        return $this->filterRepository->createFromArray($data);
    }

}
