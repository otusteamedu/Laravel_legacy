<?php


namespace App\Services\Segments;

use App\Models\Segment;
use App\Services\Segments\Handlers\CreateSegmentHandler;
use App\Services\Segments\Repositories\CategoryRepositoryInterface;
use App\Services\Segments\Repositories\SegmentRepositoryInterface;


class SegmentsService
{
    private $segmentRepository;
    private $createSegmentHandler;

    public function __construct(
        CreateSegmentHandler $createSegmentHandler,
        SegmentRepositoryInterface $segmentRepository
    )
    {
        $this->createSegmentHandler = $createSegmentHandler;
        $this->segmentRepository = $segmentRepository;
    }

    /**
     * @param array $data
     * @return Segment
     */
    public function storeSegment(array $data): Segment
    {
        return $this->createSegmentHandler->handle($data);
    }

}
