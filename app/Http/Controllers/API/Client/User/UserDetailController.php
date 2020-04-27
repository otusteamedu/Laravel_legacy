<?php

namespace App\Http\Controllers\API\Client\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormRequest;
use App\Services\User\ClientUserDetailService;

class UserDetailController extends Controller
{
    private ClientUserDetailService $service;

    public function __construct(ClientUserDetailService $service)
    {
        $this->service = $service;
    }

    public function getItem()
    {
        return response()->json($this->service->getItem());
    }

    public function update(FormRequest $request)
    {
        return $this->service->update($request->all());
    }
}
