<?php

namespace AElsukov\Repositories\Section;

use AElsukov\DataClasses\Section\SectionListParam;
use AElsukov\Models\Section;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface SectionRepositoryInterface
 * @package AElsukov\Repositories\Section
 */
interface SectionRepositoryInterface
{
    /**
     * @return Collection|null
     */
    public function all(): ?Collection;

    /**
     * @param  SectionListParam  $sectionListParam
     * @return Collection|null
     */
    public function getList(SectionListParam $sectionListParam): ?Collection;

    /**
     * @param  int  $id
     * @return Section
     */
    public function getById(int $id): Section;

    /**
     * @param  string  $slug
     * @return Section
     */
    public function getBySlug(string $slug): Section;
}
