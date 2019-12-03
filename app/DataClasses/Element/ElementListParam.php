<?php

namespace AElsukov\DataClasses\Element;

use AElsukov\DataClasses\AbstractListParam;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ElementListParam
 * @package AElsukov\DataClasses\Element
 */
class ElementListParam extends AbstractListParam
{
    /** @var int $sectionId */
    protected $sectionId;

    /**
     * @param  int  $sectionId
     * @return $this
     */
    public function setSection(int $sectionId): self
    {
        $this->sectionId = $sectionId;
        return $this;
    }

    /**
     * @return Builder
     */
    public function getResult(): Builder
    {
        return $this->builder
            ->when($this->sectionId, function (Builder $builder, int $sectionId) {
                return $builder->where('section_id', '=', $sectionId);
            })
            ->when($this->active, function (Builder $builder, int $active) {
                return $builder->where('active', '=', $active);
            });
    }
}
