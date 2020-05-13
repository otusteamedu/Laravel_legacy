<?php

namespace App\Job\Files;


use App\Helpers\FilesWork;
use App\Http\Services\Files\ImageResizeServices;
use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\Facades\Image;


class FilesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const DISC = 'public';
    const IMF_HEIGHT_SIZE = [
        '300',
        '400',
        '500'
    ];
    /**
     * @var News
     */
    private $news;

    /**
     * FilesJob constructor.
     * @param News $news
     */
    public function __construct(
        News $news
    ) {
        $this->news = $news;
    }

    public function handle()
    {
        $filePath = FilesWork::getPath(News::FILE_PATH, $this->news->id, $this->news->file);
        $exists = Storage::disk(self::DISC)->exists($filePath);
        if($exists){
            foreach(self::IMF_HEIGHT_SIZE AS $size){

                $newFilePath = FilesWork::getPath(News::FILE_PATH, $this->news->id, "{$size}/".$this->news->file);
                $newPath = FilesWork::getPath(News::FILE_PATH, $this->news->id, "{$size}/");
                Storage::disk(self::DISC)->deleteDirectory($newPath);
                $copyFile = Storage::disk(self::DISC)->copy($filePath, $newFilePath);

                $existNewFile = Storage::disk(self::DISC)->exists($newFilePath);
                if($existNewFile && $copyFile){
                    $fullPath = FilesWork::getFullDiscPath(self::DISC).$newFilePath;
                    $img = Image::make($fullPath);
                    $img->resize(null, $size, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($fullPath);
                }
            }

        }

    }

    public function failed()
    {
        throw new \Exception("FILE don't save");
    }
}
