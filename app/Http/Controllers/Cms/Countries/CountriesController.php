<?php
namespace App\Http\Controllers\Cms\Countries;

use App\Services\Countries\CountriesService;
use App\Services\Currencies\CurrenciesService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Cms\Countries\Requests\StoreCountryRequest;
use App\Http\Controllers\Cms\Countries\Requests\UpdateCountryRequest;
use App\Http\Controllers\Cms\Countries\Requests\DeleteCountryRequest;

use Illuminate\Http\Response;
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
        $name = $request->get('name', '');
        $data = $this->countriesService->searchByNames((string)$name);
        $currencies = $this->currenciesService->all();
        $currencies[''] = '';
        return view('cms.countries', [
            'countries' => $data,
            'name' => $name,
            'currencies' => $currencies,
        ]);
    }


    /**
     * Сохранение страны
     *
     * @param Request $request
     * @return string
     */
    public function store(StoreCountryRequest $request): string
    {
        try {
            $country = $this->countriesService->store($request->all());
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
    public function update(UpdateCountryRequest $request): string
    {
        $id = (int)$request->get('id', 0);
        try {
            $country = $this->countriesService->update($id, $request->all());
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
    public function delete(DeleteCountryRequest $request): string
    {
        $id = $request->get('id');
        try {
            $this->countriesService->delete($id);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Delete error',
                'errors' => [[ $e->getMessage() ]],
            ], 400)->send();
        }
        return json_encode([]);
    }
}
