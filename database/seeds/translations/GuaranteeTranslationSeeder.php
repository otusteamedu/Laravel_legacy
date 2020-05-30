<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Guarantee;
use App\Models\Translations\GuaranteeTranslation;

class GuaranteeTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guarantee_translations')->truncate();

        $guarantees = Guarantee::all();

        foreach ($guarantees as $guarantee) {
            $guaranteeTranslation = new GuaranteeTranslation();
            $guaranteeTranslation->guarantee_id = $guarantee->id;
            $guaranteeTranslation->locale = 'ru';
            $guaranteeTranslation->attribute = 'name';
            $guaranteeTranslation->value = $guarantee->name . 'Ru';
            $guaranteeTranslation->save();
        }
    }
}