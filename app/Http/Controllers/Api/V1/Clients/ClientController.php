<?php

namespace App\Http\Controllers\Api\V1\Clients;

use App\Http\Controllers\Api\V1\Clients\Requests\ClientListRequest;
use App\Http\Controllers\Api\V1\Clients\Requests\ClientSaveRequest;
use App\Http\Controllers\Api\V1\Clients\Requests\ClientStoreRequest;
use App\Http\Controllers\Api\V1\Clients\Resources\ClientResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\Clients\Resources\ClientCollectionResource;
use App\Models\Group;
use App\Models\User;
use App\Services\Users\DTO\User as UserDTO;
use App\Services\Users\UsersService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ClientController extends Controller
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
     * @param Request $request
     *
     * @return ClientResource
     */
    public function current(Request $request)
    {
        return new ClientResource($request->user());
    }

    /**
     * Display a listing of the resource.
     *
     * @param ClientListRequest $request
     *
     * @return ClientCollectionResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(ClientListRequest $request)
    {
        $this->authorize('client.viewAny');

        $request->getBuilder()->setFilters([
            [function(Builder $query) {
                $query->whereIn('group_id', Group::CLIENTS);
            }]
        ])->setWith(['group']);

        $collection = $this->usersService->getAll($request->getBuilder());

        $resource = new ClientCollectionResource($collection);
        $resource->with['total'] = $request->getBuilder()->getTotal();

        return $resource;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClientStoreRequest $request
     *
     * @return ClientResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(ClientStoreRequest $request)
    {
        $this->authorize('client.create');

        $userDTO = UserDTO::fromArray(array_merge(
            $request->getFormData(),
            ['group_id' => Group::CLIENTS[0]]
        ));

        $user = $this->usersService->sendInviteClient($userDTO);

        return new ClientResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param User $client
     *
     * @return ClientResource|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(User $client)
    {
        $this->authorize('client.view', $client);

        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClientSaveRequest $request
     * @param User              $client
     *
     * @return ClientResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(ClientSaveRequest $request, User $client)
    {
        $this->authorize('client.update', $client);

        $client = $this->usersService->updateUser($client, $request->toArray());

        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $client
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \App\Services\Users\Exceptions\IncorrectUserException
     */
    public function destroy(User $client)
    {
        $this->authorize('client.delete', $client);

        $this->usersService->deleteUser($client);

        return response()->json(['status' => 'ok']);
    }
}
