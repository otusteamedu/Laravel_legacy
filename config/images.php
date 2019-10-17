<?php
return [
    'dir' => env('IMAGES_DIR', 'uploads/images'),
    'extension' => env('IMAGES_EXTENSION', 'png'),
    'sizes' => [
        '-400x0' => [
            'width' => 400,
            'height' => 0
        ],
    ],
];