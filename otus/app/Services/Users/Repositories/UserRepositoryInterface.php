<?php


namespace App\Services\Users\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface {

    public function find(int $id);

    public function search(array $filters = [], array $with = []): LengthAwarePaginator ;

    public function destroy(array $ids) ;

    public function createFromArray(array $data):User ;

    public function updateFromArray(User $user, array $data) :User;
}
