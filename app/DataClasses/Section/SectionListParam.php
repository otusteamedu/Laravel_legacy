<?php

namespace AElsukov\DataClasses\Section;

use AElsukov\DataClasses\AbstractListParam;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SectionListParam
 * @package AElsukov\DataClasses\Section
 */
class SectionListParam extends AbstractListParam
{
    /** @var int $sectionId */
    protected $sectionId;

    /** @var int $leftMargin */
    protected $leftMargin;

    /** @var int $rightMargin */
    protected $rightMargin;

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
     * @param  int  $leftMargin
     * @return $this
     */
    public function setLeftMargin(int $leftMargin): self
    {
        $this->leftMargin = $leftMargin;
        return $this;
    }

    /**
     * @param  int  $rightMargin
     * @return $this
     */
    public function setRightMargin(int $rightMargin): self
    {
        $this->rightMargin = $rightMargin;
        return $this;
    }

    /**
     * @return Builder
     */
    public function getResult(): Builder
    {
        return $this->builder
            ->when($this->sectionId, function (Builder $builder, int $sectionId) {
                return $builder->where('parent_id', '=', $sectionId);
            })
            ->when($this->active, function (Builder $builder, int $active) {
                return $builder->where('active', '=', $active);
            })
            ->when($this->leftMargin, function (Builder $builder, int $leftMargin) {
                return $builder->where('left_margin', '>=', $leftMargin);
            })
            ->when($this->rightMargin, function (Builder $builder, int $rightMargin) {
                return $builder->where('right_margin', '<=', $rightMargin);
            });
    }
}
