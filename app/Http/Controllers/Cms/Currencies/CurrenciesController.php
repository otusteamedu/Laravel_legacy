<?php

namespace App\Http\Controllers\Cms\Currencies;

use App\Services\Currencies\CurrenciesService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Cms\Currencies\Requests\StoreCurrencyRequest;
use App\Http\Controllers\Cms\Currencies\Requests\UpdateCurrencyRequest;
use App\Http\Controllers\Cms\Currencies\Requests\DeleteCurrencyRequest;
/**
 * Class CurrenciesController
 * @package App\Http\Controllers\Cms\Currencies
 */
class CurrenciesController extends Controller
{

    protected $currenciesService;

    public function __construct(
        CurrenciesService $currenciesService
    )
    {
        $this->currenciesService = $currenciesService;
    }

    /**
     * Вывод списка валют
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $code = $request->get('code', '');
        $currencies = $this->currenciesService->searchByCode($code);
        return view('cms.currencies', ['currencies' => $currencies, 'code' => $code]);
    }

    /**
     * Сохранение страны
     *
     * @param Request $request
     * @return string
     */
    public function store(StoreCurrencyRequest $request): string
    {
        try {
            $country = $this->currenciesService->store($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Store error',
                'errors' => [[ $e->getMessage() ]],
            ], 400)->send();
        }
        return response()->json($country,200)->send();
    }

    /**
     * Изменение страны
     *
     * @param Request $request
     * @return string
     */
    public function update(UpdateCurrencyRequest $request): string
    {
        $id = (int)$request->get('id', 0);
        try {
            $country = $this->currenciesService->update($id, $request->all());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Update error',
                'errors' => [[ $e->getMessage() ]],
            ], 400)->send();
        }
        return json_encode($country);
    }


    /**
     * Удаление страны
     *
     * @param Request $request
     * @return string
     */
    public function delete(DeleteCurrencyRequest $request): string
    {
        $id = $request->get('id');
        try {
            $this->currenciesService->delete($id);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Delete error',
                'errors' => [[ $e->getMessage() ]],
            ], 400)->send();
        }
        return json_encode([]);
    }

}
