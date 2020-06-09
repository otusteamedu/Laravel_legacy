<?php


namespace App\Services\Filters\Handlers;


use App\Models\Filter;
use App\Services\Filters\Events\FilterCreated;
use App\Services\Filters\Repositories\FilterRepositoryInterface;
use App\Services\Filters\Resolvers\FilterAdditionalDataResolver;

class CreateFilterHandler
{
    private FilterRepositoryInterface $filterRepository;
    private FilterAdditionalDataResolver $resolver;

    public function __construct(
        FilterRepositoryInterface $filterRepository,
        FilterAdditionalDataResolver $resolver
    )
    {
        $this->filterRepository = $filterRepository;
        $this->resolver = $resolver;
    }

    public function handle(array $data): Filter
    {
        //Just for practise
        $data = $this->resolver->resolve($data);
//        FilterCreated::dispatch(); //Dispatch Event ????
        event(new FilterCreated('test@test.loc'));
        return $this->filterRepository->createFromArray($data);
    }

}
