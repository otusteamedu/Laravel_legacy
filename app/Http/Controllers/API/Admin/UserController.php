<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserList as UserListResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll() {
        return Response::Json(UserListResource::collection(User::all()));
    }

    public function getItem($id) {
        return Response::Json(new UserResource(User::findOrFail($id)));
    }

    public function create(CreateUserRequest $request) {
        return Response::Json($this->repository->create($request));
    }

    public function update($id, UpdateUserRequest $request) {
        return Response::Json($this->repository->update($id, $request));
    }

    public function publish($id) {
        return Response::Json($this->repository->publish($id));
    }

    public function delete($id) {
        return Response::Json(User::findOrFail($id)->delete());
    }

    public function passwordChange($id, Request $request) {
        return Response::Json($this->repository->passwordChange($id, $request));
    }
}
