<?php


namespace App\Repositories\People;

use App\Models\Person;
use Illuminate\Database\Eloquent\Collection;

interface IPersonRepository
{
    public function find(int $id);
    public function search(array $filters = []) : Collection;
    public function createFromArray(array $data): Person;
    public function updateFromArray(Person $person, array $data): Person;
    public function remove(Person $person);
}
