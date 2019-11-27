<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Models\User;

class MoviesTableSeeder extends Seeder
{
    protected $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function run()
    {
        //
        $path = dirname(__FILE__) . "/../../public/storage/seeds";
        $xmlFile = realpath($path . "/movies.xml");
        $imagePath = realpath($path . "/movies");

        $repository = app()->make(\App\Repositories\Interfaces\IMovieRepository::class);
        $service = app()->make(\App\Services\Interfaces\IMovieService::class);

        $allGenresId = $repository->getAvailGenres()->pluck('id');
        $allProducersId = $repository->getAvailProducers()->pluck('id');
        $allCountiesId = $repository->getAvailCountries()->pluck('id');
        $allActorsId = $repository->getAvailActors()->pluck('id');
        $ageLimits = $repository->getAgeLimits();

        $document = new DOMDocument();
        $document->load($xmlFile);
        $nodeMovies = $document->getElementsByTagName('movie');

        $user_get = (new User)->newQuery()
            ->select('users.id')
            ->leftJoin('user_role', 'users.id', '=', 'user_role.user_id')
            ->leftJoin('roles', 'user_role.role_id', '=', 'roles.id')
            ->where('roles.code', '=', 'root')
            ->get()->toArray();

        $created_user_id = empty($user_get) ? 0 : $user_get[0]['id'];

        \App\Models\Movie::reguard();
        /** @var DOMElement $movie */
        foreach ($nodeMovies as $movie) {
            $data = [];
            /** @var DOMElement $child */
            foreach ($movie->childNodes as $child) {
                if($child->nodeType == XML_ELEMENT_NODE) {
                    $tagName = strtolower($child->tagName);
                    switch ($tagName) {
                        case 'name':
                            $data['name'] = $child->nodeValue;
                            break;
                        case 'link':
                            $data['trailer_link'] = $child->nodeValue;
                            break;
                        case 'description':
                            $data['description'] = $child->nodeValue;
                            break;
                        case 'picture':
                            $fileName = $imagePath . "/" . $child->nodeValue;
                            $fz = getimagesize($fileName);
                            $data['poster'] = new \Illuminate\Http\UploadedFile(
                                $fileName, basename($fileName),
                                $fz['mime'],
                                UPLOAD_ERR_OK,
                                true
                            );
                            break;
                    }
                }
            }

            $data['slogan'] = $this->faker->text(random_int(40, 80));

            $data['producer_id'] = $allProducersId->shuffle()->first();
            $data['created_user_id'] = $created_user_id;

            $data['genres_id'] = $allGenresId->shuffle()->slice(0, random_int(1, 4))->toArray();
            $data['countries_id'] = $allCountiesId->shuffle()->slice(0, random_int(1, 3))->toArray();
            $data['actors_id'] = $allActorsId->shuffle()->slice(0, random_int(5, 10))->toArray();

            $data['duration'] = random_int(60, 120);
            $data['premiereDate'] = $this->faker->dateTimeBetween('-45 days', '15 days')->format(
                \App\Helpers\Views\AdminHelpers::FORMAT_SITE_DATE
            );

            shuffle($ageLimits);
            $data['age_limit'] = $ageLimits[0];

            $service->store($data);
        }
    }
}
