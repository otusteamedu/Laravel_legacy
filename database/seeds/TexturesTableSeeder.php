<?php

use Illuminate\Database\Seeder;

class TexturesTableSeeder extends Seeder
{
    private string $uploadDir;
    private string $seedsUploadImageDir;
    private string $seedsImageDir;

    public function __construct()
    {
        $this->uploadDir = public_path(config('uploads.image_upload_path'));
        $this->seedsUploadImageDir = config('seeds.seeds_uploads_path') . 'textures';
        $this->seedsImageDir = public_path(config('seeds.seeds_path'));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::deleteDirectory($this->seedsImageDir);
        File::makeDirectory($this->seedsImageDir, config('uploads.storage_permissions', 0755));

        $images = getImagesFromLocal($this->seedsUploadImageDir);

        foreach (config('seeds.textures') as $texture) {
            DB::table('textures')->insert([
                'name' => $texture['name'],
                'thumb_path' => $this->getTextureImagePath($images, 'thumb', $texture['image_key']),
                'sample_path' => $this->getTextureImagePath($images, 'sample', $texture['image_key']),
                'background_path' => $this->getTextureImagePath($images, 'background', $texture['image_key']),
                'width' => $texture['width'],
                'price' => $texture['price'],
                'description' => $texture['description'],
                'publish' => 1
            ]);
        }

        File::deleteDirectory($this->seedsImageDir);
    }

    protected function getTextureImagePath(array $images, string $article, string $imageKey)
    {
        $imageName = 'texture-' . $article . '-' . $imageKey . '.jpg';
        $imageUploadFile = getImageByNameFromLocal($images, $imageName, $this->seedsUploadImageDir, $this->seedsImageDir);
        $imageAttributes = uploader()->upload($imageUploadFile, $this->uploadDir);

        return $imageAttributes['path'];
    }
}
