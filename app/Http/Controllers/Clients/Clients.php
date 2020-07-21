<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Group;
use App\Services\Users\DTO\User as UserDTO;
use App\Services\Users\UsersService;

class Clients extends Controller
{
    /**
     * @var UsersService
     */
    private $usersService;

    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('client.viewAny');

        $list = $this->usersService->searchUsers(Group::CLIENTS);
        $list->load('group');

        return view('clients.index')->with([
            'list' => $list,
            'title' => __("clients/general.title")
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('client.create');

        return view('clients.create')->with([
            'title' => __("clients/create.title")
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('client.create');

        $userDTO = UserDTO::fromArray(array_merge(
            $request->getFormData(),
            ['group_id' => Group::CLIENTS[0]]
        ));

        $this->usersService->sendInviteClient($userDTO);

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $client = $this->usersService->findUser($id);

        if (!$client) {
            abort(404);
        }

        $this->authorize('client.view', [$client]);

        return view('clients.show')->with([
            'client' => $client,
            'title' => $client->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $client = $this->usersService->findUser($id);

        if (!$client) {
            abort(404);
        }

        $this->authorize('client.update', [$client]);

        return view('clients.edit')->with([
            'client' => $client,
            'title' => __("clients/edit.title")
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param int               $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $client = $this->usersService->findUser($id);

        if (!$client) {
            abort(404);
        }

        $this->authorize('client.update', [$client]);

        $this->usersService->updateUser($client, $request->getFormData());

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $client = $this->usersService->findUser($id);

        if (!$client) {
            abort(404);
        }

        $this->authorize('client.delete', [$client]);

        $this->usersService->deleteUser($client);

        return redirect(route('clients.index'));
    }
}
