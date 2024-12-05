<?php

namespace AElsukov\Services\Section;

use AElsukov\DataClasses\Section\SectionListParam;
use AElsukov\Models\Section;
use AElsukov\Repositories\Section\SectionRepositoryInterface;
use Illuminate\Support\Collection;

/**
 * Class SectionService
 * @package AElsukov\Services\Section
 */
class SectionService
{
    /** @var SectionRepositoryInterface $sectionRepository */
    protected $sectionRepository;

    /**
     * SectionService constructor.
     * @param  SectionRepositoryInterface  $sectionRepository
     */
    public function __construct(SectionRepositoryInterface $sectionRepository)
    {
        $this->sectionRepository = $sectionRepository;
    }

    /**
     * @return Collection|null
     */
    public function getSectionList(): ?Collection
    {
        return $this->sectionRepository->getList(
            (new SectionListParam())
            ->setActive(true)
        );
    }

    /**
     * @param  string  $slug
     * @return Section
     */
    public function getSection(string $slug): Section
    {
        return $this->sectionRepository->getBySlug($slug);
    }
}
