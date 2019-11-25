<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Заполняем сеансы по следующей схеме
 * 1. Считатем, что сеансы фильмов во всех залах кинотеатров идут непрерывно с минимальным перерывом в 15 минут
 * 2. Время начала сеанса кратно 15 минутам
 * 3. Вся сеть кинотеатров работает по единому графику с 12-00 до 23-00
 * 4. Каждый фильм показывается в течении 21 дня с даты премьеры
 * 5. Идем по возможным датам проката, далее по всем залам кинчиков, далее по циклическому алгоритму
 * выбираем фильм, для которого текущая дата входит в промежуток дата премеьры + 21 день и назначаем сеанс.
 *
 * Class MovieShowingsTableSeeder
 */

class MovieShowingsTableSeeder extends Seeder
{
    const SHOWING_INTERVAL = 21;
    const DELTA_MINUTES = 15;

    private $iRoundCounter;

    public function __construct() {
        $this->iRoundCounter = 0;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $bounds = $this->getDateBounds();

        /** @var Carbon $currentDate */
        $currentDate = Carbon::createFromFormat("Y-m-d H:i", $bounds->minDate." 00:00");
        /** @var Carbon $endDate */
        $endDate = Carbon::createFromFormat("Y-m-d H:i", $bounds->maxDate." 00:00");

        \App\Models\MovieRental::reguard();
        \App\Models\MovieShowing::reguard();

        $halls = \App\Models\Hall::all();
        do {
            /** @var \App\Models\Hall $hall */
            foreach ($halls as $hall) {
                /** @var Carbon $currentDatetime */
                $currentDatetime = $currentDate->clone()->addHours(12);
                /** @var Carbon $endDatetime */
                $endDatetime = $currentDate->clone()->addHours(23);

                // забиваем залы сеансами
                do {
                    $cinema = $hall->cinema;
                    $movie = $this->getNextMovie($currentDate);
                    if(!$movie)
                        return;

                    // смещение в минутах в соответсвии с п.2
                    $delta = intval(($movie->duration + self::DELTA_MINUTES) / self::DELTA_MINUTES) * self::DELTA_MINUTES;
                    //$delta = 180;
                    $movieRental = $this->getRental($movie, $cinema);

                    $model = new \App\Models\MovieShowing;
                    $model->hall()->associate($hall);
                    $model->movieRental()->associate($movieRental);
                    $model->datetime = $currentDatetime;
                    $model->save();

                    $currentDatetime->addMinutes($delta);
                }
                while($currentDatetime->lte($endDatetime));
            }

            $currentDate->addDay();
        }
        while($currentDate->lte($endDate));

        $this->updateRentals();
    }

    public function updateRentals() {
        $movieRentals = \App\Models\MovieRental::query()->orderBy('id')->get()->all();
        foreach ($movieRentals as $rental)
            $this->updateRental($rental);
    }
    public function updateRental(\App\Models\MovieRental $movieRental)
    {
        $data = DB::table('movie_showings')
            ->where('movie_rental_id', '=', $movieRental->id)
            ->selectRaw('min(`datetime`) as minDate, max(`datetime`) as maxDate')
            ->get()->first();

        if($data) {
            $movieRental->date_start_at = Carbon::createFromFormat("Y-m-d H:i:s", $data->minDate);
            $movieRental->date_end_at = Carbon::createFromFormat("Y-m-d H:i:s", $data->maxDate);

            $movieRental->save();
        }
    }

    public function getNextMovie(Carbon $now): ?\App\Models\Movie {
        /** @var Carbon $to */
        $to = $now->clone()->subDays(self::SHOWING_INTERVAL);

        $query = \App\Models\Movie::query()
            ->select(['id', 'premiereDate'])
            ->where('premiereDate', '<=', $now->format('Y-m-d'))
            ->where('premiereDate', '>=', $to->format('Y-m-d'));

        $count = $query->count();
        if($count <= 0)
            return null;

        if($this->iRoundCounter >= $count)
            $this->iRoundCounter = 0;

        $movie = \App\Models\Movie::query()
            ->where('premiereDate', '<=', $now->format('Y-m-d'))
            ->where('premiereDate', '>=', $to->format('Y-m-d'))
            ->orderBy('premiereDate', 'asc')
            ->offset($this->iRoundCounter)
            ->limit(1)->get()->first();

        $this->iRoundCounter++;

        return $movie ?? null;
    }

    public function getRental(\App\Models\Movie $movie, \App\Models\Cinema $cinema): \App\Models\MovieRental
    {
        $model = \App\Models\MovieRental::query()
            ->where ('movie_id', '=', $movie->id)
            ->where('cinema_id', '=', $cinema->id)
            ->get()->first();

        if(!$model) {
            /** @var \App\Models\User $user */
            $user = $this->getRootUser();
            $model = new \App\Models\MovieRental;
            $model->movie()->associate($movie);
            $model->cinema()->associate($cinema);
            $model->owner()->associate($user);
            //$model->created_at = Carbon::now();
            //$model->updated_at = Carbon::now();

            $model->save();
        }

        return $model;
    }

    public function getDateBounds() {
        return DB::table('movies')
            ->selectRaw('ADDDATE(min(premiereDate), '.self::SHOWING_INTERVAL.') as minDate, ADDDATE(max(premiereDate), 7) as maxDate')
            ->get()->first();
    }

    public function getRootUser(): ?\App\Models\User {
        $user_get = (new \App\Models\User)->newQuery()
            ->select('users.id')
            ->leftJoin('user_role', 'users.id', '=', 'user_role.user_id')
            ->leftJoin('roles', 'user_role.role_id', '=', 'roles.id')
            ->where('roles.code', '=', 'root')
            ->get()->toArray();

        $created_user_id = empty($user_get) ? 0 : $user_get[0]['id'];

        return \App\Models\User::find($created_user_id);
    }


}
