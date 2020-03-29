<?php

namespace App\Services\Pictures\Resolvers;

use Illuminate\Http\UploadedFile;
use App\Services\Pictures\Repositories\PictureRepositoryInterface;

class PictureIdByUploadedFileResolver
{
    private $pictureRepository;

    public function __construct(
        PictureRepositoryInterface $pictureRepository
    )
    {
        $this->pictureRepository = $pictureRepository;
    }

    public function resolve(UploadedFile $uploadedFile) {
        $filename = md5(time()) . '.' . $uploadedFile->getClientOriginalExtension();

        $picture = \Image::make($uploadedFile);

        if ($picture->getWidth() > \Config::get('images.avatar.size.width')
            || $picture->getHeight() > \Config::get('images.avatar.size.height')
        ) {
            $picture->resizeCanvas(
                \Config::get('images.avatar.size.width'),
                \Config::get('images.avatar.size.height')
            );
        }

        $picture->save(storage_path('app/public/upload/') . $filename);

        // @ToDo: в данном месте было бы проще использовать фабрику
        // вот так: $pictureId = factory(Picture::class, 1)->create(['path' => $filename])->first()->id;
        // распространен ли такой подход? Или фабрики лучше использовать только для сидинга и тестов?
        $pictureId = $this->pictureRepository->createFromArray(['path' => $filename])->id;

        return $pictureId;
    }
}
