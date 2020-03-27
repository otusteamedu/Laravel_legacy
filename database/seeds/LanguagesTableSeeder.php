<?php

use App\Models\Country;
use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    private function getAvailableLanguageList()
    {
        return [
            [
                'name' => 'english',
                'code' => 'eng',
                'country_id' => null,
            ],
            [
                'name' => 'русский',
                'code' => 'rus',
                'country_id' => Country::where('phone_code', '+7')->value('id')
            ],
            [
                'name' => 'українська',
                'code' => 'ukr',
                'country_id' => Country::where('phone_code', '+38')->value('id')
            ],
            [
                'name' => '中文',
                'code' => 'zho',
                'country_id' => null,
            ]
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getAvailableLanguageList() as $language) {
            factory(Language::class, 1)->create($language);
        }
    }
}
