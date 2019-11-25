<?php


namespace App\Repositories;

use App\Base\Repository\BaseRepository;
use App\Repositories\Interfaces\IPersonRepository;
use App\Models\Person;
use Illuminate\Database\Eloquent\Collection;

class PersonRepository extends BaseRepository implements IPersonRepository
{
}
