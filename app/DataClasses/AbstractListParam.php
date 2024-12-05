<?php

namespace AElsukov\DataClasses;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class AbstractListParam
 * @package AElsukov\DataClasses
 */
abstract class AbstractListParam
{
    /** @var Builder $builder */
    protected $builder;

    /** @var string $active */
    protected $active;

    /**
     * @param  bool  $active
     * @return $this
     */
    public function setActive(bool $active): self
    {
        $this->active = $active ? 'Y' : 'N';
        return $this;
    }

    /**
     * @param  Builder  $builder
     * @return $this
     */
    public function setBuilder(Builder $builder): self
    {
        $this->builder = $builder;
        return $this;
    }

    /**
     * @return Builder
     */
    abstract public function getResult(): Builder;
}
