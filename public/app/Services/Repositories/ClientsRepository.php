<?php


namespace App\Services\Repositories;

use App\Models\Clients\Client;
use Illuminate\Http\Request;

/**
 * Class ClientsRepository
 * @package App\Services\Repositories
 */

class ClientsRepository implements RepositoryInterface
{
    public function index()
    {
        return Client::with(['region'])->paginate(20);
    }

    public function store(Request $request)
    {
        $model = new Client;
        $model->name = $request->name;
        $model->region_id = $request->region_id;
        $model->save();
    }

    public function show($id)
    {
        return Client::find($id);
    }

    public function edit($id)
    {
        return Client::find($id);
    }

    public function update(Request $request, $model)
    {
        $truck = Client::find($model->id);
        $truck->name = $request->name;
        $truck->region_id = $request->region_id;
        $truck->save();
    }

    public function destroy($model)
    {
        $model->delete();
    }
}
