<?php

use Illuminate\Database\Seeder;
use App\Models\File;
use App\Models\User;
use App\Models\Blog\BlogCategory;

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
        factory(File::class, 1)->create([
            'usage' => File::USAGE_BLOG_CATEGORY_DETAIL_PICTURE
        ])->each(function ($detailImage) {

            /** СОЗДАЕМ МИНИАТЮРУ **/
            // Получаем путь для превью картинки
            $strPreviewImageName = App\Providers\Faker\Image::imageName();
            $strPreviewImagePath = storage_path(join(DIRECTORY_SEPARATOR, Array(File::STORAGE_PATH, $strPreviewImageName)));

            // Ресайзим картинку
            $detailPicture = \Intervention\Image\Facades\Image::make($detailImage->fullPath());
            $detailPicture->resize(320, 320)->save($strPreviewImagePath);

            $arFile = \App\Helpers\File\Helper::getFileArray($strPreviewImagePath);
            $arFile['source_id'] = $detailImage->id;

            // Сохраняем картинку
            $previewImage = File::create($arFile);

            // Получаем админа
            $user = User::find(1)->first();

            factory(BlogCategory::class, 1)->create([
                'preview_picture_id' => $previewImage->id,
                'detail_picture_id' => $detailImage->id,
                'created_by_id' => $user->id,
            ]);
        });
    }
}
