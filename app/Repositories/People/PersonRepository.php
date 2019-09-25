<?php


namespace App\Repositories\People;


use App\Models\Person;
use Illuminate\Database\Eloquent\Collection;

class PersonRepository implements IPersonRepository
{
    public function find(int $id)
    {
        return Person::find($id);
    }
    public function search(array $filters = []): Collection
    {
        //return Country::paginate();
        return Person::all();
    }
    public function createFromArray(array $data): Person
    {
        $person = new Person();
        return $person->create($data);
    }
    public function updateFromArray(Person $person, array $data): Person
    {
        $person->update($data);
        return $person;
    }
    public function remove(Person $person) {
        $person->delete();
    }
}
