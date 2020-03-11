<?php

namespace App\Http\Controllers\Cms\Countries;

use App\Services\Countries\CountriesService;
use App\Services\Currencies\CurrenciesService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class CurrenciesController
 * @package App\Http\Controllers\Cms\Countries
 */
class CountriesController extends Controller
{

    protected $countriesService;
    protected $currenciesService;

    public function __construct(
        CountriesService $countriesService,
        CurrenciesService $currenciesService
    )
    {
        $this->countriesService = $countriesService;
        $this->currenciesService = $currenciesService;
    }

    /**
     * Вывод списка стран
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $this->countriesService->search($request->all(), true);
        $currencies = $this->currenciesService->all();
        $currencies[''] = '';
        return view('cms.countries', [
            'countries' => $data,
            'name' => $request->get('name', ''),
            'currencies' => $currencies,
        ]);
    }


    /**
     * Сохранение страны
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request): string
    {
        $result = 'success';
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_eng' => 'required',
        ]);

        if ($validator->fails()) {
            $result = $validator->errors();
        } else {
            $id = (int)$request->get('id', 0);
            if ($id) {
                $success = $this->countriesService->update($id, $request->all());
            } else {
                $success = $this->countriesService->store($request->all());
            }
            if (!$success) {
                $result = $this->countriesService->getErrors();
            }
        }

        return json_encode(['result' => $result]);
    }

    /**
     * Удаление страны
     *
     * @param Request $request
     * @return string
     */
    public function delete(Request $request): string
    {
        $result = 'success';
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $result = $validator->errors();
        } else {
            $id = $request->get('id');
            $success = $this->countriesService->delete($id);
            if (!$success) {
                $result = $this->countriesService->getErrors();
                if (empty($result)) {
                    $result = 'Не удалось удалить запись!';
                }
            }
        }
        return json_encode(['result' => $result]);
    }
}
