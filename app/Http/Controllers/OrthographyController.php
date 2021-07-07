<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Orthography\OrthographyService;


class OrthographyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private $orthographyService;

    public function __construct(
        OrthographyService $orthographyService
    )
    {
        $this->orthographyService = $orthographyService;
    }

    public function list()
    {
        $list = $this->orthographyService->list();
        return view('orthography.list')->with(['list' => $list]);
    }

    public function detail(string $id)
    {
        $list = $this->orthographyService->list();
        $detail = $this->orthographyService->detail($id);
        return view('orthography.detail')->with(
            [
                'list' => $list,
                'detail' => $detail
            ]);
    }
}
