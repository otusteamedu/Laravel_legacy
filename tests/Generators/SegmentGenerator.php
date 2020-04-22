<?php


namespace Tests\Generators;


use App\Models\Segment;

/**
 * Class SegmentGenerator
 * @package Tests\Generators
 */
class SegmentGenerator
{
    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function createSegment (array $data = [])
    {
        return factory(Segment::class)->create($data);
    }
}
