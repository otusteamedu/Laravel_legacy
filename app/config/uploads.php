<?php

return [
    'storagePath' => 'storage/',
    'imageUploadPath' => 'storage/uploads/images/',
    'imageDefaultPath' => 'storage/uploads/images/noimage.png',
    'storagePermissions' => 0755,
    'imageCacheTime' => 86400,
    'image_upload_rules' => [
        'max_size' => 5242880,
        'min_size' => 10240,
        'extensions' => [
            'jpeg',
            'jpg',
            'png'
        ],
        'mime' => [
            'image/jpeg',
            'image/png'
        ],
    ],
    'serviceImagesPath' => 'uploads/service-images'
];
