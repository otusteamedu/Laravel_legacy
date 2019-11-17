<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll() {
        return Response::Json($this->repository->getAll());
    }

    public function getItem($id) {
        return Response::Json($this->repository->getItem($id));
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
        return Response::Json($this->repository->delete($id));
    }
}
