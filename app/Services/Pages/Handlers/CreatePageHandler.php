<?php

namespace App\Services\Pages\Handlers;


use App\Models\Page;
use App\Services\Pages\Repositories\EloquentPageRepository;

class CreatePageHandler
{

    private $pageRepository;

    public function __construct(
        EloquentPageRepository $pageRepository
    )
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param array $data
     * @return Page
     */
    public function handle(array $data): Page
    {
        return $this->pageRepository->createFromArray($data);
    }

}
