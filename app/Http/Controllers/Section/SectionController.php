<?php

namespace AElsukov\Http\Controllers\Section;

use AElsukov\Http\Controllers\Controller;
use AElsukov\Services\Element\ElementService;
use AElsukov\Services\Section\SectionService;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class SectionController
 * @package AElsukov\Http\Controllers
 */
class SectionController extends Controller
{
    /** @var SectionService  */
    protected $sectionService;

    /**
     * SectionController constructor.
     */
    public function __construct()
    {
        $this->sectionService = app(SectionService::class);
    }

    /**
     * @return View
     */
    public function main(): View
    {
        $sectionList = $this->sectionService->getSectionList();

        return view('main', ['sectionList' => $sectionList]);
    }

    /**
     * @param  string  $slug
     * @return View
     */
    public function section(string $slug): View
    {
        $section = $this->sectionService->getSection($slug);

        /** @var ElementService $elementService */
        $elementService = app(ElementService::class);

        $elementCollection =$elementService->getElementSection($section->id);

        return view('main', ['section' => $section, 'elementCollection' => $elementCollection]);
    }
}
