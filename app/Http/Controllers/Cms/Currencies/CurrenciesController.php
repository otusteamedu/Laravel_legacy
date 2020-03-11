<?php

namespace App\Http\Controllers\Cms\Currencies;

use App\Services\Currencies\CurrenciesService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
        $currencies = $this->currenciesService->search($request->all());
        return view('cms.currencies', ['currencies' => $currencies, 'code' => $request->get('code', '')]);
    }


    /**
     * Сохранение валюты
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request): string
    {
        $result = 'success';
        $validator = Validator::make($request->all(), [
            'code' => 'required|alpha_num',
        ]);

        if ($validator->fails()) {
            $result = $validator->errors();
        } else {
            $id = (int)$request->get('id', 0);
            if ($id) {
                $success = $this->currenciesService->update($id, $request->all());
            } else {
                $success = $this->currenciesService->store(['code' => $request->get('code')]);
            }
            if (!$success) {
                $result = $this->currenciesService->getErrors();
            }
        }

        return json_encode(['result' => $result]);
    }

    /**
     * Удаление валюты
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
            $success = $this->currenciesService->delete($id);
            if (!$success) {
                $result = $this->currenciesService->getErrors();
                if (empty($result)) {
                    $result = 'Не удалось удалить запись!';
                }
            }
        }
        return json_encode(['result' => $result]);
    }
}
