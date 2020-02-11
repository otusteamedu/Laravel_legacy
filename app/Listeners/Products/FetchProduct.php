<?php

namespace App\Listeners\Products;

use App\Jobs\Queue;
use App\Services\Products\Repositories\ProductsRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FetchProduct implements ShouldQueue
{

    use InteractsWithQueue;

    public $queue = Queue::PRODUCTS;

    /**
     * @var ProductsRepositoryInterface
     */
    protected $productsRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ProductsRepositoryInterface $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * Handle the event.
     *
     * @param array $event
     * @return void
     */
    public function handle(array $event)
    {
        //throw new \Exception();
        $this->productsRepository->create($event);
    }
}
