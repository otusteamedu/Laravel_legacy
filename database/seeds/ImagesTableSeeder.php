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
        $seedsUploadImageDir = config('seeds.seeds_uploads_path');
        $seedsImageDir = public_path(config('seeds.seeds_path'));

        File::deleteDirectory($uploadDir);
        File::makeDirectory($uploadDir, config('uploads.storage_permissions', 0755)
        );

        File::deleteDirectory($seedsImageDir);
        File::makeDirectory($seedsImageDir, config('uploads.storage_permissions', 0755));

        $images = getImagesFromLocal($seedsUploadImageDir);

        $i = 0;
        while ($i < 10) {

            $uploadedImage = getFakerImageFromLocal($images, $seedsUploadImageDir, $seedsImageDir);

            factory(App\Models\Image::class)->create(uploader()->upload($uploadedImage, $uploadDir));

            $i++;
        }

        File::deleteDirectory($seedsImageDir);
    }
}
