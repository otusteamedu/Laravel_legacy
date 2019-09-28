<?php


namespace App\Services\Repositories;

use Illuminate\Http\Request;

interface RepositoryInterface
{
    public function index();

    public function store(Request $request);

    public function show($id);

    public function edit($id);

    public function update(Request $request, $model);

    public function destroy($id);
}

