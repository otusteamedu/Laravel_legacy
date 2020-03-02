<?php

return [
    'storagePath' => 'storage/',
    'image_upload_path' => 'storage/uploads/images/',
    'image_default_path' => 'storage/uploads/no_image/no_image.png',
    'storage_permissions' => 0755,
    'image_resize_quality' => 90,
    'image_cache_time' => 86400,
    'image_upload_rules' => [
        'max_size' => 5242880,
        'min_size' => 3072,
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
    'serviceImagesPath' => 'uploads/service-images',
    'image_sizes' => [
        ['width' => 1920, 'height' => 1080],
        ['width' => 1920, 'height' => 1080],
        ['width' => 1920, 'height' => 1080],
        ['width' => 1920, 'height' => 960],
        ['width' => 1920, 'height' => 700],
        ['width' => 1600, 'height' => 1080],
        ['width' => 1600, 'height' => 1080],
        ['width' => 1400, 'height' => 1080],
        ['width' => 1400, 'height' => 1080],
        ['width' => 1200, 'height' => 1080],
        ['width' => 1080, 'height' => 1080]
    ],
    'category_image_size' => [
        'width' => 1920,
        'height' => 1080
    ],
    'texture_image_sizes' => [
        'thumb' => ['width' => 300, 'height' => 300],
        'sample' => ['width' => 800, 'height' => 800],
        'background' => ['width' => 1920, 'height' => 1080]
    ]
];
