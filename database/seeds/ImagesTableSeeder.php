<?php

use Illuminate\Database\Seeder;


class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uploadDir = public_path(config('uploads.image_upload_path'));

        File::deleteDirectory($uploadDir);
        File::makeDirectory($uploadDir, config('uploads.storage_permissions', 0755));

        factory(App\Models\Image::class, 30)->create();
    }
}
