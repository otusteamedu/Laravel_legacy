<?php

namespace App\Jobs;

use App\Models\Image as ImageModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessImageThumbnails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $image;

    /**
     * Create a new job instance.
     *
     * @param ImageModel $image
     */
    public function __construct(ImageModel $image)
    {
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //dd(1);
        // access the model in the queue for processing
        $image = $this->image;
        $full_image_path = public_path($image->org_path);
        $resized_image_path = public_path('thumbs' . DIRECTORY_SEPARATOR .  $image->org_path);

        // create image thumbs from the original image
        $img = \Intervention\Image::make($full_image_path)->resize(300, 200);
        $img->save($resized_image_path);    }
}
