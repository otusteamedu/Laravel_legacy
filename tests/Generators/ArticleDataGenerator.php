<?php
namespace Tests\Generators;

use App\Models\User;
use App\Models\UserGroup;
use App\Services\UserGroupsService;
use App\Services\CategoriesService;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


/**
 * Class ArticleDataGenerator
 * @package Tests\Generators
 */
class ArticleDataGenerator
{
    /**
     * @var Faker
     */
    private $faker;

    /**
     * ArticleDataGenerator constructor.
     * @param Faker $faker
     */
    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * @return array
     */
    public function generateValidData()
    {
        $data = [
            'title' => $this->faker->realText(255),
            'intro_text' => $this->faker->realText(255),
            'full_text' => $this->faker->realText(1000),
            'category_id' => 1,
        ];

        return $data;
    }

    /**
     * @return array
     */
    public function generateInvalidTitleData()
    {
        $data = [
            'title' => null,
            'intro_text' => $this->faker->realText(255),
            'full_text' => $this->faker->realText(1000),
            'category_id' => 1,
        ];

        return $data;
    }

    /**
     * @return array
     */
    public function generateInvalidIntroTextData()
    {
        $data = [
            'title' =>  $this->faker->realText(255),
            'intro_text' => null,
            'full_text' => $this->faker->realText(1000),
            'category_id' => 1,
        ];

        return $data;
    }

    /**
     * @return array
     */
    public function generateInvalidCategoryData()
    {
        $data = [
            'title' => $this->faker->realText(255),
            'intro_text' => $this->faker->realText(255),
            'full_text' => $this->faker->realText(1000),
            'category_id' => null,
        ];

        return $data;
    }


}
