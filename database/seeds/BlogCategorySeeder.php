<?php

use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Сидим одну картинку для превью
        factory(\App\Models\File::class, 1)->create([
            'usage' => App\Models\File::USAGE_BLOG_CATEGORY_DETAIL_PICTURE
        ])->each(function ($detailImage) {

            /** СОЗДАЕМ МИНИАТЮРУ **/
            // Получаем путь для превью картинки
            $strPreviewImageName = App\Providers\Faker\Image::imageName();
            $strPreviewImagePath = storage_path(join(DIRECTORY_SEPARATOR, Array(\App\Models\File::STORAGE_PATH, $strPreviewImageName)));

            // Ресайзим картинку и сорхраняем ее
            $detailPicture = \Intervention\Image\Facades\Image::make($detailImage->fullPath());
            $detailPicture->resize(320, 320)->save($strPreviewImagePath);

            $arFile = \App\Helpers\File\Helper::getFileArray($strPreviewImagePath);
            $arFile['source_id'] = $detailImage->id;

            $previewImage = \App\Models\File::create($arFile);

            factory(\App\Models\Blog\Category::class, 1)->create([
                'preview_picture_id' => $previewImage->id,
                'detail_picture_id' => $detailImage->id,
            ]);
        });
    }
}
