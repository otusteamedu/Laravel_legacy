<?php


namespace App\Repositories;


use App\Base\Repository\BaseRepository;
use App\Base\Service\Q;
use App\Helpers\Views\AdminHelpers;
use App\Models\File;
use App\Models\Movie;
use App\Models\User;
use App\Repositories\Files\IFileRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\ICountryRepository;
use App\Repositories\Interfaces\IGenreRepository;
use App\Repositories\Interfaces\IPersonRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\Interfaces\IMovieRepository;

class MovieRepository extends BaseRepository implements IMovieRepository
{
    private $age_limits;
    private $personRepository;
    private $genreRepository;
    private $countryRepository;
    private $userRepository;
    private $fileRepository;

    public function __construct(
        IPersonRepository $personRepository,
        IGenreRepository $genreRepository,
        ICountryRepository $countryRepository,
        IUserRepository $userRepository,
        IFileRepository $fileRepository
    ) {
        parent::__construct();

        $this->personRepository = $personRepository;
        $this->genreRepository = $genreRepository;
        $this->countryRepository = $countryRepository;
        $this->userRepository = $userRepository;
        $this->fileRepository = $fileRepository;

        $this->age_limits = [
            '0', '6', '12', '16', '18'
        ];
    }

    public function getAgeLimits(): array {
        return $this->age_limits;
    }

    public function makeRelations(Movie $movie, array $data): Model {
        if(array_key_exists('created_user_id', $data)) {
            $data['created_user_id'] = (int) $data['created_user_id'];
            if($data['created_user_id'] > 0) {
                $user = $this->userRepository->getByPrimary($data['created_user_id']);
                $movie->owner()->associate($user);
            }
            elseif($movie->created_user_id)
                $movie->owner()->dissociate();
        }

        if(array_key_exists('producer_id', $data)) {
            $data['producer_id'] = (int) $data['producer_id'];
            if($data['producer_id'] > 0) {
                $producer = $this->personRepository->getByPrimary($data['producer_id']);
                $movie->producer()->associate($producer);
            }
            elseif($movie->producer_id)
                $movie->producer()->dissociate();
        }

        if(array_key_exists('poster_id', $data)) {
            $data['poster_id'] = (int) $data['poster_id'];
            if($data['poster_id'] > 0) {
                $poster = $this->fileRepository->find($data['poster_id']);
                $movie->poster()->associate($poster);
            }
            elseif($movie->poster_id)
                $movie->poster()->dissociate();
        }

        if(array_key_exists('actors_id', $data) && is_array($data['actors_id'])) {
            $actors_id = [];
            $old_actors_id = $movie->actors->pluck('id')->toArray();
            foreach ($data['actors_id'] as $actor_id) {
                $actor = $this->personRepository->getByPrimary($actor_id);
                if($actor) {
                    $bCreate = !in_array($actor_id, $old_actors_id);
                    $actors_id[$actor_id] = AdminHelpers::DbTimeStamps($bCreate);
                }
            }
            $movie->actors()->sync($actors_id);
        }

        if(array_key_exists('countries_id', $data) && is_array($data['countries_id'])) {
            $countries_id = [];
            $old_countries_id = $movie->countries->pluck('id')->toArray();
            foreach ($data['countries_id'] as $country_id) {
                $country = $this->countryRepository->getByPrimary($country_id);
                if($country) {
                    $bCreate = !in_array($country_id, $old_countries_id);
                    $countries_id[$country_id] = AdminHelpers::DbTimeStamps($bCreate);
                }
            }
            $movie->countries()->sync($countries_id);
        }

        if(array_key_exists('genres_id', $data) && is_array($data['genres_id'])) {
            $genres_id = [];
            $old_genres_id = $movie->genres->pluck('id')->toArray();
            foreach ($data['genres_id'] as $genre_id) {
                $genre = $this->genreRepository->getByPrimary($genre_id);
                if($genre) {
                    $bCreate = !in_array($genre_id, $old_genres_id);
                    $genres_id[$genre_id] = AdminHelpers::DbTimeStamps($bCreate);
                }
            }
            $movie->genres()->sync($genres_id);
        }

        $movie->push();

        return $movie;
    }

    public function createFromArray(array $data): Model {
        //$data
        $data['premiereDate'] = AdminHelpers::Date_site_db($data['premiereDate']);
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        if(!array_key_exists('created_user_id', $data)) {
            /** @var User $user */
            $user = $this->userRepository->currentUser();
            $data['created_user_id'] = $user->id;
        }

        /** @var $movie Movie */
        $movie = parent::createFromArray($data);
        $movie = $this->makeRelations($movie, $data);

        return $movie;
    }
    /**
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function updateFromArray(Model $model, array $data): Model {
        if(array_key_exists('premiereDate', $data))
            $data['premiereDate'] = AdminHelpers::Date_site_db($data['premiereDate']);
        if(array_key_exists('created_user_id', $data))
            unset($data['created_user_id']);

        $data['updated_at'] = Carbon::now();

        /** @var $movie Movie */
        $movie = parent::updateFromArray($model, $data);
        $movie = $this->makeRelations($movie, $data);

        return $movie;
    }
    /**
     * @param Model $model
     * @throws Exception
     */
    public function remove(Model $model) {
        $data = [
            'producer_id'=> 0,
            'poster_id' => 0,
            'created_user_id' => 0,
            'actors_id' => [],
            'countries_id' => [],
            'genres_id' => []
        ];

        // разрывание ассоциированных связей
        /** @var Movie $model */
        $model = $this->makeRelations($model, $data);

        $model->delete();
    }

    public function detachPoster(Movie $movie): ?File {
        if(!$movie->poster)
            return null;

        $file = $movie->poster;
        $movie->poster()->dissociate();
        $movie->save();

        return $file;
    }

    public function getAvailProducers(): Collection {
        return $this->personRepository->getList();
    }

    public function getAvailActors(): Collection {
        return $this->personRepository->getList();
    }

    public function getAvailCountries(): Collection {
        return $this->countryRepository->getList();
    }

    public function getAvailGenres(): Collection {
        return $this->genreRepository->getList();
    }
    /**
     * Получить фильмы, которые будут скоро в показе.
     * 1. Дата премьеры должна быть больше текущей
     * 2. Сеансы должны существовать
     * 3. Дата-время первого сеанса должна быть больше текущего
     *
     * @param int $nLastCount
     * @return Collection
     * @throws \App\Base\WrongNamespaceException
     */
    public function getSoonInRental(int $nLastCount): Collection {
        /** @var Movie $movieModel */
        $now = Carbon::now();

        $query = $this->getModel()->newQuery()
            ->select(['movies.*'])
            ->join('movie_rentals', 'movies.id', '=', 'movie_rentals.movie_id')
            ->where('movies.premiereDate', '>=', $now->format('Y-m-d'))
            ->where('movie_rentals.date_start_at', '>', $now)
            ->groupBy('movies.id')
            ->orderBy('movie_rentals.date_start_at')
            ->limit($nLastCount);

        return $query->get();
    }
    /**
     * @param int $nCount
     * @return Collection
     * @throws \App\Base\WrongNamespaceException
     */
    public function getInRentalRand(int $nCount): Collection {
        $now = Carbon::now();

        $query = $this->getModel()->newQuery()
            ->select(['movies.*'])
            ->join('movie_rentals', 'movies.id', '=', 'movie_rentals.movie_id')
            ->where('movies.premiereDate', '<=', $now->format('Y-m-d'))
            ->where('movie_rentals.date_start_at', '<=', $now)
            ->where('movie_rentals.date_end_at', '>=', $now)
            ->groupBy('movies.id')
            ->orderByRaw('rand()')
            ->limit($nCount);

        return $query->get();
    }
}
