<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Status;
use App\Services\Statuses\StatusesService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class StatusesController extends BaseAdminController
{
    protected $statusesService;
    protected $breadcrumbs;

    public function __construct(
        StatusesService $statusesService

    )
    {
        $this->statusesService = $statusesService;
        $this->breadcrumbs = $this->getAdminBreadcrumbs();
        array_push($this->breadcrumbs,
            [
                'url' => route('admin.statuses.index'),
                'title' => __('messages.statuses'),
            ]
        );

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $this->checkCurrentUserRouteAccess($user, $request->route()->getName());
        return view('admin.statuses.index', [
            'statuses' => $this->statusesService->searchStatuses(),
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.statuses.create', [
            'breadcrumbs' => $this->breadcrumbs

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:statuses,name|max:100',

        ]);

        $this->statusesService->storeStatus($request->all());

        return redirect(route('admin.statuses.index'));
    }

    /**
     * Display the specified resource.
     *
     *
     * @param  0   int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        return view('admin.statuses.edit',
            [
                'status' => $status,
                'breadcrumbs' => $this->breadcrumbs
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $result = $this->statusesService->updateStatus($status, $request->all());

        if ($result == 1) {
            return redirect(route('admin.statuses.index'));
        } else {
            return back()->with($result);

        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->statusesService->deleteStatus($id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect(route('admin.statuses.index', ['result' => $result]));
    }
}
