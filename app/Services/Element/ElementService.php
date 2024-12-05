<?php

namespace AElsukov\Services\Element;

use AElsukov\DataClasses\Element\ElementListParam;
use AElsukov\Models\Element;
use AElsukov\Repositories\Element\ElementRepositoryInterface;
use Illuminate\Support\Collection;

/**
 * Class ElementService
 * @package AElsukov\Services\Element
 */
class ElementService
{
    /** @var ElementRepositoryInterface $elementRepository */
    protected $elementRepository;

    /**
     * ElementService constructor.
     * @param  ElementRepositoryInterface  $elementRepository
     */
    public function __construct(ElementRepositoryInterface $elementRepository)
    {
        $this->elementRepository = $elementRepository;
    }

    /**
     * @param  string  $slug
     * @return Element
     */
    public function getElement(string $slug): Element
    {
        return $this->elementRepository->getBySlug($slug);
    }

    /**
     * @param  int  $sectionId
     * @return Collection|null
     */
    public function getElementSection(int $sectionId): ?Collection
    {
        return $this->elementRepository->getList(
            (new ElementListParam())
            ->setSection($sectionId)
            ->setActive(true)
        );
    }
}
