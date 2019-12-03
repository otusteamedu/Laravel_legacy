<?php

namespace AElsukov\Repositories\Element;

use AElsukov\DataClasses\Element\ElementListParam;
use AElsukov\Models\Element;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ElementRepositoryInterface
 * @package AElsukov\Repositories\Element
 */
interface ElementRepositoryInterface
{
    /**
     * @return Collection|null
     */
    public function all(): ?Collection;

    /**
     * @param  ElementListParam $elementListParam
     * @return Collection|null
     */
    public function getList(ElementListParam $elementListParam): ?Collection;

    /**
     * @param  int  $id
     * @return Element
     */
    public function getById(int $id): Element;

    /**
     * @param  string  $slug
     * @return Element
     */
    public function getBySlug(string $slug): Element;
}
