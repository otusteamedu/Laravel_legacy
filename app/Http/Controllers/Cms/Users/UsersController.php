<?php

namespace App\Http\Controllers\Cms\Users;

use App\Http\Controllers\Cms\Users\Requests\StoreUserRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cms\Users\Requests\StoreCityRequest;
use App\Models\Segment;
use App\Models\Tariff;
use App\Models\User;
use App\Services\Users\UsersService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use View;


class UsersController extends Controller
{
    /**
     * @var UsersService
     */
    protected $usersService;

    public function __construct(
        UsersService $usersService
    )
    {
        $this->usersService = $usersService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('cms.users.index', ['users' => User::paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (Gate::allows('create-user')) {

            $tariffs = Tariff::all();
            $segments = Segment::all();

            return view('cms.users.create', [
                'tariffs' => $tariffs,
                'segments' => $segments,
            ]);
        }else{
            return view('errors.not-allowed');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->getFormData();

        try {
            $this->usersService->storeUser($data);
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->error(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Store user error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route('cms.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('cms.users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        if (Gate::allows('update-user')) {
            return view('cms.users.edit', [
                'user' => $user,
            ]);
        }else{
            return view('errors.not-allowed');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, User $user)
    {
        $this->authorize(Abilities::UPDATE, $user);

        try {
            $this->usersService->updateUser($user, $request->all());
            $user->update($request->all());
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->error(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Update user error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route('cms.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
