<?php

namespace App\Policies;

use App\Models\Movie;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class MoviePolicy
{
    use HandlesAuthorization;

    private $repository;

    public function __construct(IUserRepository $repository) {
        $this->repository = $repository;
    }
    /**
     * @param User $user
     * @param $ability
     * @return mixed
     */
    public function before(User $user, $ability) {
        if($user->isRoot())
            return true;
    }
    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user) {
        return $this->repository->requiredAccess($user, "movie" , "R");
    }
    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user) {
        return $this->store($user);
    }
    /**
     * @param User $user
     * @return bool
     */
    public function store(User $user) {
        return $this->repository->requiredAccess($user, "movie" , "U");
    }
    /**
     * Determine whether the user can view the movie.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Movie  $movie
     * @return mixed
     */
    public function edit(User $user, Movie $movie) {
        return $this->update($user, $movie);
    }
    /**
     * Determine whether the user can update the movie.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Movie  $movie
     * @return mixed
     */
    public function update(User $user, Movie $movie)
    {
        $access = ($user->id == $movie->created_user_id) ? "U" : "Z";
        return $this->repository->requiredAccess($user, "movie" , $access);
    }

    /**
     * Determine whether the user can delete the movie.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Movie  $movie
     * @return mixed
     */
    public function delete(User $user, Movie $movie)
    {
        $access = ($user->id == $movie->created_user_id) ? "U" : "Z";
        return $this->repository->requiredAccess($user, "movie" , $access);
    }
}
