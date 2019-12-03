<?php

namespace AElsukov\Http\Controllers\Element;

use AElsukov\Http\Controllers\Controller;
use AElsukov\Services\Element\ElementService;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class ElementController
 * @package AElsukov\Http\Controllers
 */
class ElementController extends Controller
{
    /** @var ElementService  */
    protected $elementService;

    /**
     * ElementController constructor.
     */
    public function __construct()
    {
        $this->elementService = app(ElementService::class);
    }

    /**
     * @param  string  $slug
     * @return View
     */
    public function index(string $slug): View
    {
        $element = $this->elementService->getElement($slug);
        return view('element', ['element' => $element]);
    }
}
