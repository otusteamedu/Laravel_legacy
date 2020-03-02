<?php

namespace App\Listeners\Cache\Image;

use App\Listeners\Cache\ClearByTag;
use App\Services\Image\CmsImageService;

class ImageClearByTag extends ClearByTag
{
    public function __construct(CmsImageService $service)
    {
        parent::__construct($service);
    }
}
