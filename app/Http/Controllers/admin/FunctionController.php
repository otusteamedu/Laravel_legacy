<?php

namespace App\Http\Controllers\admin;

use App\Services\Admin\AdminFunctionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class FunctionController extends Controller
{
    protected $response = null;
    protected $adminFunctionService;

    public function __construct(AdminFunctionService $adminFunctionService)
    {
        $this->adminFunctionService = $adminFunctionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.function.index', [
            'response' => $this->response,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|max:50',
                'function' => 'required|max:50',
                'description' => 'required|max:450',
            ]);
        } catch (ValidationException $e) {
            return view('admin.function.index')
                ->with($request->all())
                ->withErrors($e->validator);
        }


            $userCreate = $this->adminFunctionService->storeFunction($request->all());
            if($userCreate->exists()){
                $this->response = 'Функция успешно добавлена';
            }

        return view('admin.function.index', [
            'response' => $this->response,
        ]);
    }

}
