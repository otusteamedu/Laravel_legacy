<?php

namespace App\Services\Users\Handlers;

use Illuminate\Http\UploadedFile;

class UserUploadPhotoHandler {

    public function handle(UploadedFile $photo) {

        if (!$photo) {
            return null;
        }

        return $photo->store('users/photo', 'public');
    }

}
