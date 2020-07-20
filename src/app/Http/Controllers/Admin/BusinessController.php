<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\StoreBusinessRequest;
use App\Http\Requests\Business\UpdateBusinessRequest;
use App\Models\Business;
use App\Providers\RouteServiceProvider;
use App\Services\Businesses\BusinessesService;
use App\Services\Businesses\Repositories\BusinessRepositoryInterface;
use App\Services\BusinessTypes\Repositories\EloquentBusinessTypeRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;

class BusinessController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * @var BusinessesService
     */
    private $service;
    /**
     * @var BusinessRepositoryInterface
     */
    private $repository;

    public function __construct(
        BusinessRepositoryInterface $repository,
        BusinessesService $service
    )
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * Страница со списком всех записей
     *
     * @return void
     */
    public function index()
    {
        $businesses = $this->repository->get();
        return view('admin.business.index', [
            'businesses' => $businesses,
        ]);
    }

    /**
     * Страница с деталями записи
     * @param Business $business
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Business $business)
    {
        return view('admin.business.view', [
            'business' => $business,
        ]);
    }

    /**
     * Форма добавления записи
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $businessTypes = (new EloquentBusinessTypeRepository())->get();
        return view('admin.business.create', [
            'business' => new Business(),
            'businessTypes' => $businessTypes
        ]);
    }

    /**
     * Добавление записи
     * @param StoreBusinessRequest $request
     * @return \Illuminate\Http\RedirectResponse
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
        $businessTypes = (new EloquentBusinessTypeRepository())->get();

        return view('admin.business.edit', [
            'business' => $business,
            'businessTypes' => $businessTypes,
        ]);
    }

    /**
     * Редактирование записи
     * @param UpdateBusinessRequest $request
     * @param Business $business
     */
    public function update(UpdateBusinessRequest $request, Business $business)
    {
        $this->service->update($request->getFormData(), $business);
    }

    /**
     * Удалить запись
     * @param Business $business
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Business $business)
    {
        $this->service->delete($business);
        return Redirect::to(action([self::class, 'index']));
    }
}
