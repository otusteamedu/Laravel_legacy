<?php
/**
 * Dynamic image resizer routes
 */
Route::group(['prefix' => 'image'], function() {
    Route::get('resize/{width}/{height}/{path}','ImageResize\ImageResizeController@resize')
        ->where([
            'width' => '\d+',
            'height' => '\d+',
            'path' => '[\w\.]+',
        ]);

    Route::get('fit/{width}/{height}/{path}','ImageResize\ImageResizeController@fit')
        ->where([
            'width' => '\d+',
            'height' => '\d+',
            'path' => '[\w\.]+',
        ]);

    Route::get('widen/{width}/{path}','ImageResize\ImageResizeController@widen')
        ->where([
            'width' => '\d+',
            'path' => '[\w\.]+',
        ]);

    Route::get('heighten/{height}/{path}','ImageResize\ImageResizeController@heighten')
        ->where([
            'height' => '\d+',
            'path' => '[\w\.]+',
        ]);

    Route::get('show/{path}','ImageResize\ImageResizeController@show')->where('path','[\w\.]+');
});
