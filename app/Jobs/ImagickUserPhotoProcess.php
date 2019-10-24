<?php

namespace App\Jobs;

use App\Jobs\Middleware\RateLimited;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ImagickUserPhotoProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var User */
    protected $user;
    protected $data;

    public function __construct(User $user, array $data = [])
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * @throws \ImagickException
     */
    public function handle()
    {
        echo UserPhotoProcess::class, '@handle:', $this->user->id, PHP_EOL;
        info($this->user->id, $this->data);
        $this->processImage($this->user->photo);
//        throw new \Exception();
    }

    /**
     * @param $filename
     * @throws \ImagickException
     */
    private function processImage($filename)
    {
        $sizes = config('images.sizes');
        $image = new \Imagick($this->getFilePath($filename));
        foreach ($sizes as $suffix => $size) {
            $image->thumbnailImage($size['width'], $size['height']);
            $filePath = $this->getFilePath($filename, $suffix);
            $image->writeImage($filePath);
        }
    }

    private function getFilePath($filename, $suffix = '')
    {
        $imageDir = ''; //config('images.dir');
        $parts = explode('.', $filename);
        $extension = array_pop($parts);

        $thumbFilename = implode('.', $parts) . "{$suffix}.{$extension}";

        return storage_path("app/public/{$imageDir}{$thumbFilename}");
    }



}
