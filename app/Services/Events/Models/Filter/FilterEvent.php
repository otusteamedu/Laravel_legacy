<?php


namespace App\Services\Events\Models\Filter;


use App\Models\Filter;

abstract class FilterEvent
{

    /**
     * @var Filter
     */
    private Filter $filter;

    public function __construct(Filter $filter)
    {

        $this->filter = $filter;
    }

    public function getFilter(): Filter
    {
        return $this->filter;
    }

}
