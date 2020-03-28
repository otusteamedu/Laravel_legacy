<?php


namespace App\Services\Segments\Handlers;


use App\Models\Segment;
use App\Services\Segments\Repositories\EloquentSegmentRepository;

class CreateSegmentHandler
{

    private $segmentRepository;

    public function __construct(
        EloquentSegmentRepository $segmentRepository
    )
    {
        $this->segmentRepository = $segmentRepository;
    }

    /**
     * @param array $data
     * @return Segment
     */
    public function handle(array $data): Segment
    {
        return $this->segmentRepository->createFromArray($data);
    }

}
