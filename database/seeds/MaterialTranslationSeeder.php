<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Material;
use App\Models\MaterialTranslation;

class MaterialTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('material_translations')->truncate();

        $materials = Material::all();

        foreach ($materials as $material) {
            $materialTranslation = new MaterialTranslation();
            $materialTranslation->material_id = $material->id;
            $materialTranslation->attribute = 'name';
            $materialTranslation->value = $material->name . 'Ru';
            $materialTranslation->save();
        }
    }
}
