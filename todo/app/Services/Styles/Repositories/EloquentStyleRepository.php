<?php
/**
 */

namespace App\Services\Styles\Repositories;


use App\Models\Style;

class EloquentStyleRepository implements StyleRepositoryInterface
{

    public function find(int $id)
    {
        return Style::find($id);
    }

    public function search(array $filters = [])
    {
        return Style::paginate();

    }

    public function searchToArray(array $filters = [])
    {
        return Style::all();
    }

    public function createFromArray(array $data): Style
    {
        $style = new Style();
        $style = $style->create($data);
        return $style;
    }

    public function updateFromArray(Style $style, array $data)
    {
        $result = Style::where('name', $data['name'])->get();
        if ((count($result) > 1) || (count($result) == 1 && $result[0]->id != $style->id)) {

            return ['error' => 'Это имя уже успользуется'];
        }
        $style->update($data);
        return 1;
    }

    public function create(array $data): Style
    {
        return $this->createFromArray($data);
    }

    public function delete(int $id)
    {
        return Style::destroy($id);
    }

}