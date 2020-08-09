<?php

namespace App\Http\Controllers;

use App\Http\Requests\Business\StoreBusinessRequest;
use App\Http\Requests\Business\UpdateBusinessRequest;
use App\Models\Business;
use App\Services\Businesses\BusinessService;
use App\Services\BusinessTypes\BusinessTypeService;
use Illuminate\Support\Facades\Redirect;

class BusinessController extends Controller
{
    /**
     * @var BusinessService
     */
    private $service;
    /**
     * @var BusinessTypeService
     */
    private $typeService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        BusinessService $service,
        BusinessTypeService $typeService
    )
    {
        $this->service = $service;
        $this->typeService = $typeService;
    }

    /**
     * Главная страница салона
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('business.index', [
            'business' => $this->service->getMyBusiness()
        ]);
    }

    /**
     * Вывод страницы салона
     * @param Business $business
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Business $business)
    {
        return view('business.show', [
            'business' => $business
        ]);
    }

    /**
     * Страница добавления салона
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View+
     */
    public function create()
    {
        $businessTypes = $this->typeService->list();
        return view('business.create', [
            'business' => new Business(),
            'businessTypes' => $businessTypes,
        ]);
    }

    /**
     * Добавление записи
     * @param StoreBusinessRequest $request
     * @return mixed
     */
    public function store(StoreBusinessRequest $request)
    {
        $this->service->create($request->getFormData());
        return Redirect::to(action([self::class, 'index']));
    }

    /**
     * Форма редактирование записи
     * @param Business $business
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Business $business)
    {
        $businessTypes = $this->typeService->list();

        return view('business.edit', [
            'business' => $business,
            'businessTypes' => $businessTypes,
        ]);
    }

    /**
     * Редактирование записи
     * @param UpdateBusinessRequest $request
     * @param Business $business
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBusinessRequest $request, Business $business)
    {
        $this->service->update($request->getFormData(), $business);
        return Redirect::to(action([self::class, 'index']));
    }

    /**
     * Удалить запись
     * @param Business $business
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Business $business)
    {
        $this->service->delete($business);
        return Redirect::home();
    }
}
