<?php

namespace AElsukov\Repositories\Element;

use AElsukov\DataClasses\Element\ElementListParam;
use AElsukov\Models\Element;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ElementRepository
 * @package AElsukov\Repositories\Element
 */
class ElementRepository implements ElementRepositoryInterface
{
    /** @inheritDoc */
    public function all(): ?Collection
    {
        return Element::all();
    }

    /** @inheritDoc */
    public function getList(ElementListParam $elementListParam): ?Collection
    {
        return $elementListParam
            ->setBuilder(Element::query())
            ->getResult()
            ->get();
    }

    /** @inheritDoc */
    public function getById(int $id): Element
    {
        return Element::query()->find($id);
    }

    /** @inheritDoc */
    public function getBySlug(string $slug): Element
    {
        return Element::query()->where('slug', '=', $slug)->firstOrFail();
    }
}
