<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'manager'], function() {


    // Images

    Route::post('images/{id}', 'Cms\Image\ImageController@update');
    Route::get('images/{id}/publish', 'Cms\Image\ImageController@publish');
    Route::apiResource('images', 'Cms\Image\ImageController')->except(['create', 'edit', 'update']);


    // Catalog

    Route::group(['prefix' => 'catalog'], function () {


        // Categories

        Route::group(['prefix' => 'categories'], function() {
            Route::get('type/{type}', 'Cms\Category\CategoryController@indexByType')
                ->where('type', '[a-z]+');
            Route::get('{id}/with-images', 'Cms\Category\CategoryController@showWithImages')
                ->where('id', '[0-9]+');
            Route::get('{id}/with-excluded-images', 'Cms\Category\CategoryController@showWithExcludedImages')
                ->where('id', '[0-9]+');
            Route::post('{id}', 'Cms\Category\CategoryController@update')
                ->where('id', '[0-9]+');
            Route::get('{id}/images', 'Cms\Category\CategoryController@getImageList')
                ->where('id', '[0-9]+');
            Route::post('{id}/images/add', 'Cms\Category\CategoryController@addImages')
                ->where('id', '[0-9]+');
            Route::get('{id}/images/{image_id}/remove', 'Cms\Category\CategoryController@removeImage')
                ->where('id,image_id', '[0-9]+');
            Route::post('{id}/upload', 'Cms\Category\CategoryController@upload')
                ->where('id', '[0-9]+');
            Route::get('{id}/publish', 'Cms\Category\CategoryController@publish')
                ->where('id', '[0-9]+');
        });
        Route::apiResource('categories', 'Cms\Category\CategoryController')->except(['create', 'edit', 'update']);


        // Tags

        Route::group(['prefix' => 'tags'], function() {
            Route::post('{id}', 'Cms\Tag\TagController@update')
                ->where('id', '[0-9]+');
            Route::get('{id}/with-images', 'Cms\Tag\TagController@showWithImages')
                ->where('id', '[0-9]+');
            Route::get('{id}/with-excluded-images', 'Cms\Tag\TagController@showWithExcludedImages')
                ->where('id', '[0-9]+');
            Route::post('{id}', 'Cms\Tag\TagController@update')
                ->where('id', '[0-9]+');
            Route::get('{id}/images', 'Cms\Tag\TagController@getImageList')
                ->where('id', '[0-9]+');
            Route::post('{id}/images/add', 'Cms\Tag\TagController@addImages')
                ->where('id', '[0-9]+');
            Route::get('{id}/images/{image_id}/remove', 'Cms\Tag\TagController@removeImage')
                ->where('id,image_id', '[0-9]+');
            Route::post('{id}/upload', 'Cms\Tag\TagController@upload')
                ->where('id', '[0-9]+');
            Route::get('{id}/publish', 'Cms\Tag\TagController@publish')
                ->where('id', '[0-9]+');
        });
        Route::apiResource('tags', 'Cms\Tag\TagController')->except(['create', 'edit', 'update']);


        // Owners

        Route::group(['prefix' => 'owners'], function() {
            Route::post('{id}', 'Cms\Owner\OwnerController@update')
                ->where('id', '[0-9]+');
            Route::get('{id}/with-images', 'Cms\Owner\OwnerController@showWithImages')
                ->where('id', '[0-9]+');
            Route::get('{id}/with-excluded-images', 'Cms\Owner\OwnerController@showWithExcludedImages')
                ->where('id', '[0-9]+');
            Route::post('{id}', 'Cms\Owner\OwnerController@update')
                ->where('id', '[0-9]+');
            Route::get('{id}/images', 'Cms\Owner\OwnerController@getImageList')
                ->where('id', '[0-9]+');
            Route::post('{id}/images/add', 'Cms\Owner\OwnerController@addImages')
                ->where('id', '[0-9]+');
            Route::get('{id}/images/{image_id}/remove', 'Cms\Owner\OwnerController@removeImage')
                ->where('id,image_id', '[0-9]+');
            Route::post('{id}/upload', 'Cms\Owner\OwnerController@upload')
                ->where('id', '[0-9]+');
            Route::get('{id}/publish', 'Cms\Owner\OwnerController@publish')
                ->where('id', '[0-9]+');
        });
        Route::apiResource('owners', 'Cms\Owner\OwnerController')->except(['create', 'edit', 'update']);
    });


    // Textures

    Route::group(['prefix' => 'textures'], function() {
        Route::post('{id}', 'Cms\Texture\TextureController@update')
            ->where('id', '[0-9]+');
        Route::get('{id}/publish', 'Cms\Texture\TextureController@publish')
            ->where('id', '[0-9]+');
    });
    Route::apiResource('textures', 'Cms\Texture\TextureController')->except(['create', 'edit', 'update']);


    // Settings

    Route::group(['prefix' => 'settings'], function() {
        Route::post('set-text', 'Cms\Setting\SettingController@setTextValue');
        Route::post('set-image', 'Cms\Setting\SettingController@setImageValue');
        Route::post('{id}', 'Cms\Setting\SettingController@update')
            ->where('id', '[0-9]+');

        Route::get('with-types', 'Cms\Setting\SettingController@indexWithTypes');
        Route::get('with-group', 'Cms\Setting\SettingController@indexWithGroup');
    });
    Route::apiResource('settings', 'Cms\Setting\SettingController')->except(['create', 'edit', 'update']);


    // SettingGroup

    Route::group(['prefix' => 'setting-groups'], function() {
        Route::get('with-settings', 'Cms\SettingGroup\SettingGroupController@indexWithSettings');
        Route::post('{id}', 'Cms\SettingGroup\SettingGroupController@update')
            ->where('id', '[0-9]+');
    });
    Route::apiResource('setting-groups', 'Cms\SettingGroup\SettingGroupController')->except(['create', 'edit', 'update']);


    // Users

    Route::group(['prefix' => 'users'], function() {
        Route::post('{id}', 'Cms\User\UserController@update')
            ->where('id', '[0-9]+');
        Route::get('{id}/publish', 'Cms\User\UserController@publish')
            ->where('id', '[0-9]+');
        Route::post('{id}/password-change', 'Cms\User\UserController@passwordChange')
            ->where('id', '[0-9]+');
    });
    Route::apiResource('users', 'Cms\User\UserController')->except(['create', 'edit', 'update']);


    // Roles

    Route::group(['prefix' => 'roles'], function() {
        Route::post('{id}', 'Cms\Role\RoleController@update')
            ->where('id', '[0-9]+');
    });
    Route::apiResource('roles', 'Cms\Role\RoleController')->except(['create', 'edit', 'update']);


    // Permissions

    Route::group(['prefix' => 'permissions'], function() {
        Route::post('{id}', 'Cms\Permission\PermissionController@update')
            ->where('id', '[0-9]+');
    });
    Route::apiResource('permissions', 'Cms\Permission\PermissionController')->except(['create', 'edit', 'update']);


    // Deliveries

    Route::group(['prefix' => 'store/deliveries'], function() {
        Route::post('{id}', 'Cms\Delivery\DeliveryController@update')
            ->where('id', '[0-9]+');
        Route::get('{id}/publish', 'Cms\Delivery\DeliveryController@publish')
            ->where('id', '[0-9]+');
    });
    Route::apiResource('store/deliveries', 'Cms\Delivery\DeliveryController')->except(['create', 'edit', 'update']);
});
