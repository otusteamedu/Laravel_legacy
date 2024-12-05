<?php

namespace AElsukov\Repositories\Section;

use AElsukov\DataClasses\Section\SectionListParam;
use AElsukov\Models\Section;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SectionRepository
 * @package AElsukov\Repositories\Section
 */
class SectionRepository implements SectionRepositoryInterface
{
    /** @inheritDoc */
    public function all(): ?Collection
    {
        return Section::all();
    }

    /** @inheritDoc */
    public function getList(SectionListParam $sectionListParam): ?Collection
    {
        return $sectionListParam
            ->setBuilder(Section::query())
            ->getResult()
            ->get();
    }

    /** @inheritDoc */
    public function getById(int $id): Section
    {
        return Section::query()->find($id);
    }

    /** @inheritDoc */
    public function getBySlug(string $slug): Section
    {
        return Section::query()->where('slug', '=', $slug)->firstOrFail();
    }
}
