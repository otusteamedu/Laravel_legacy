<?php

namespace App\Http\Controllers\LangConstructorType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LangConstructorType\Requests\SaveLangConstructorTypeRequest;
use App\Models\ConstructionType;
use App\Services\ConstructionTypes\ConstructionTypesService;
use App\Policies\Abilities;

class LangConstructorTypeController extends Controller
{
    protected $constructionTypesService;

    public function __construct(
        ConstructionTypesService $constructionTypesService
    )
    {
        $this->constructionTypesService = $constructionTypesService;
    }
    public function index()
    {

        return view('lang-constructor.lang-constructor-type.index',['langConstructorTypes' => $this->constructionTypesService->getAllConstructionTypes()]);
    }

    public function edit($id = null)
    {

        return view('lang-constructor.lang-constructor-type.edit',['langConstructorType' => $this->constructionTypesService->findOrNew($id)]);
    }

    public function save(SaveLangConstructorTypeRequest $request)
    {
        $this->authorize(Abilities::UPDATE, ConstructionType::class);
        $data  =  $request->getFormData();

        $langConstructorType  = $this->constructionTypesService->createConstructionType($data);

        return redirect(route('lang-constructor-type-edit', ['id' => $langConstructorType->id]))->with('status',__('system.saved'));

    }

    public function delete($id)
    {
        $this->constructionTypesService->delete($id);

        return redirect(route('lang-constructor-type-index'))->with('status',__('system.deleted'));
    }
}
