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

// SDEK

//Route::get('/cdek/regions', 'CDEK\CDEKController@getRegions');
Route::post('/cdek/pvzs', 'CDEK\CDEKController@getPVZS');
Route::post('/cdek/settlements', 'CDEK\CDEKController@getSettlements');
Route::post('/cdek/price', 'CDEK\CDEKController@getPrice');
//Route::get('/cdek/curl', 'CDEK\CDEKController@curlGet');


// Authorisation

Route::group(['prefix' => '/auth', ['middleware' => 'throttle:20,5']], function() {
    Route::post('/register', 'Auth\RegisterController@register');

    Route::post('/login', 'Auth\LoginController@login')->middleware('auth.valid');

    Route::get('/login/{service}', 'Auth\SocialLoginController@redirect');
    Route::get('/login/{service}/callback', 'Auth\SocialLoginController@callback');
    Route::post('/login/{service}/register', 'Auth\SocialLoginController@registered');

    // Send reset password mail
    Route::post('/reset-password', 'Auth\ForgotPasswordController@sendPasswordResetLink');
    Route::post('/reset/password', 'Auth\ResetPasswordController@callResetPassword');
});

Route::group(['prefix' => '/auth'], function() {
    Route::get('me', 'Auth\AuthController@me');
//    Route::post('refresh', 'Auth\AuthController@refresh');
    Route::get('/logout', 'Auth\AuthController@logout')->middleware('jwt.auth');
});


// Client API

Route::post('catalog/images', 'Client\Image\ImageController@getItems');
Route::get('catalog/images/{id}', 'Client\Image\ImageController@getItem')
    ->where('id', '[0-9]+');

Route::post('catalog/images/wish-list', 'Client\Image\ImageController@getWishListItems');

Route::get('catalog/categories', 'Client\Category\CategoryController@index');

Route::get('catalog/categories/{category}', 'Client\Category\CategoryController@getItemByAlias');
Route::post('catalog/categories/{id}/images', 'Client\Category\CategoryController@getImages')
    ->where('id', '[0-9]+');

// Filters
Route::get('catalog/categories/{id}/filters', 'Client\Category\CategoryController@getFilters')
    ->name('category.filters');
Route::post('catalog/categories/filters/wish-list', 'Client\Category\CategoryController@getFiltersByImageIds')
    ->name('category.filters.wish-list');

// Delivery
Route::get('delivery', 'Client\Delivery\DeliveryController@index');

// Settings
Route::get('settings', 'Client\SettingGroup\SettingGroupController@index');

// Orders
Route::group(['prefix' => 'orders'], function() {
    Route::post('/', 'Client\Order\OrderController@store');
});

// Carts
//Route::apiResource('carts', 'Client\Cart\CartController')
//    ->except(['edit', 'delete']);
Route::group(['prefix' => 'carts'], function() {
    Route::post('/', 'Client\Cart\CartController@update')->middleware('jwt.auth');
    Route::post('sync', 'Client\Cart\CartController@sync')->middleware('jwt.auth');
    Route::post('set-qty', 'Client\Cart\CartController@setQty')->middleware('jwt.auth');
    Route::delete('{id}', 'Client\Cart\CartController@delete')
        ->where('id', '[0-9]+')
        ->middleware('jwt.auth');
    Route::post('add', 'Client\Cart\CartController@add')->middleware('jwt.auth');
});

// Users
Route::prefix('profile')
    ->middleware('jwt.auth')
    ->group(function(){
        Route::post('details', 'Client\User\UserDetailController@update');
        Route::get('details', 'Client\User\UserDetailController@getItem');
        Route::post('name', 'Client\User\UserController@updateName');
        Route::post('email', 'Client\User\UserController@updateEmail');
        Route::get('orders', 'Client\User\UserController@getOrders');
        Route::get('orders/{number}/cancel', 'Client\User\UserController@cancelOrder')
            ->where('number', '[0-9]+');
        Route::get('orders/{number}', 'Client\User\UserController@getOrder')
            ->where('number', '[0-9]+');
        Route::group(['prefix' => 'wishlist'], function() {
           Route::post('/sync', 'Client\User\UserController@syncLikes');
           Route::get('/{imageId}/toggle', 'Client\User\UserController@toggleLike')
               ->where('number', '[0-9]+');
        });
    });


// Cms

Route::group(['prefix' => 'manager'], function() {


    // Images

    Route::post('images/paginate', 'Cms\Image\ImageController@getItems')
        ->name('images.list');
    Route::post('images/{id}', 'Cms\Image\ImageController@update')
        ->name('images.update');
    Route::get('images/{id}/publish', 'Cms\Image\ImageController@publish')
        ->name('images.publish');
    Route::apiResource('images', 'Cms\Image\ImageController')
        ->except(['index', 'create', 'edit', 'update']);


    // Catalog

    Route::group(['prefix' => 'catalog'], function () {


        // Categories

        Route::group(['prefix' => 'categories'], function() {
            Route::get('type/{type}', 'Cms\Category\CategoryController@getItemsByType')
                ->where('type', '[a-z]+');
            Route::post('{id}/images', 'Cms\Category\CategoryController@getImages')
                ->where('id', '[0-9]+');
            Route::post('{id}/with-images', 'Cms\Category\CategoryController@getItemWithImages')
                ->where('id', '[0-9]+');
            Route::post('{id}/images/excluded', 'Cms\Category\CategoryController@getExcludedImages')
                ->where('id', '[0-9]+');
            Route::post('{id}/with-excluded-images', 'Cms\Category\CategoryController@getItemWithExcludedImages')
                ->where('id', '[0-9]+');
            Route::post('{id}', 'Cms\Category\CategoryController@update')
                ->where('id', '[0-9]+');
            Route::post('{id}/images/add', 'Cms\Category\CategoryController@addImages')
                ->where('id', '[0-9]+');
            Route::post('{id}/images/{image_id}/remove', 'Cms\Category\CategoryController@removeImage')
                ->where('id,image_id', '[0-9]+');
            Route::post('{id}/upload', 'Cms\Category\CategoryController@upload')
                ->where('id', '[0-9]+');
            Route::get('{id}/publish', 'Cms\Category\CategoryController@publish')
                ->where('id', '[0-9]+');
        });
        Route::apiResource('categories', 'Cms\Category\CategoryController')
            ->except(['create', 'edit', 'update']);


        // Tags

        Route::group(['prefix' => 'tags'], function() {
            Route::post('{id}', 'Cms\Tag\TagController@update')
                ->where('id', '[0-9]+');
            Route::post('{id}/images', 'Cms\Tag\TagController@getImages')
                ->where('id', '[0-9]+');
            Route::post('{id}/with-images', 'Cms\Tag\TagController@getItemWithImages')
                ->where('id', '[0-9]+');
            Route::post('{id}/images/excluded', 'Cms\Tag\TagController@getExcludedImages')
                ->where('id', '[0-9]+');
            Route::post('{id}/with-excluded-images', 'Cms\Tag\TagController@getItemWithExcludedImages')
                ->where('id', '[0-9]+');
            Route::post('{id}', 'Cms\Tag\TagController@update')
                ->where('id', '[0-9]+');
            Route::post('{id}/images/add', 'Cms\Tag\TagController@addImages')
                ->where('id', '[0-9]+');
            Route::post('{id}/images/{image_id}/remove', 'Cms\Tag\TagController@removeImage')
                ->where('id,image_id', '[0-9]+');
            Route::post('{id}/upload', 'Cms\Tag\TagController@upload')
                ->where('id', '[0-9]+');
            Route::get('{id}/publish', 'Cms\Tag\TagController@publish')
                ->where('id', '[0-9]+');
        });
        Route::apiResource('tags', 'Cms\Tag\TagController')
            ->except(['create', 'edit', 'update']);


        // Owners

        Route::group(['prefix' => 'owners'], function() {
            Route::post('{id}', 'Cms\Owner\OwnerController@update')
                ->where('id', '[0-9]+');
            Route::post('{id}/images', 'Cms\Owner\OwnerController@getImages')
                ->where('id', '[0-9]+');
            Route::post('{id}/with-images', 'Cms\Owner\OwnerController@getItemWithImages')
                ->where('id', '[0-9]+');
            Route::post('{id}/images/excluded', 'Cms\Owner\OwnerController@getExcludedImages')
                ->where('id', '[0-9]+');
            Route::post('{id}/with-excluded-images', 'Cms\Owner\OwnerController@getItemWithExcludedImages')
                ->where('id', '[0-9]+');
            Route::post('{id}', 'Cms\Owner\OwnerController@update')
                ->where('id', '[0-9]+');
            Route::post('{id}/images/add', 'Cms\Owner\OwnerController@addImages')
                ->where('id', '[0-9]+');
            Route::post('{id}/images/{image_id}/remove', 'Cms\Owner\OwnerController@removeImage')
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
    Route::apiResource('textures', 'Cms\Texture\TextureController')
        ->except(['create', 'edit', 'update']);


    // Settings

    Route::group(['prefix' => 'settings'], function() {
        Route::post('set-text', 'Cms\Setting\SettingController@setTextValue');
        Route::post('set-image', 'Cms\Setting\SettingController@setImageValue');
        Route::post('{id}', 'Cms\Setting\SettingController@update')
            ->where('id', '[0-9]+');

        Route::get('with-types', 'Cms\Setting\SettingController@getItemsWithTypes');
        Route::get('with-group', 'Cms\Setting\SettingController@getItemsWithGroup');
    });
    Route::apiResource('settings', 'Cms\Setting\SettingController')
        ->except(['create', 'edit', 'update']);


    // SettingGroup

    Route::group(['prefix' => 'setting-groups'], function() {
        Route::get('with-settings', 'Cms\SettingGroup\SettingGroupController@getItemsWithSettings');
        Route::post('{id}', 'Cms\SettingGroup\SettingGroupController@update')
            ->where('id', '[0-9]+');
    });
    Route::apiResource('setting-groups', 'Cms\SettingGroup\SettingGroupController')
        ->except(['create', 'edit', 'update']);


    // Users

    Route::group(['prefix' => 'users'], function() {
        Route::post('{id}', 'Cms\User\UserController@update')
            ->where('id', '[0-9]+')
            ->name('users.update');
        Route::get('{id}/publish', 'Cms\User\UserController@publish')
            ->where('id', '[0-9]+')
            ->name('users.publish');
        Route::post('{id}/password-change', 'Cms\User\UserController@passwordChange')
            ->where('id', '[0-9]+')
            ->name('users.password');
    });
    Route::apiResource('users', 'Cms\User\UserController')
        ->except(['create', 'edit', 'update']);


    // Roles

    Route::group(['prefix' => 'roles'], function() {
        Route::post('{id}', 'Cms\Role\RoleController@update')
            ->where('id', '[0-9]+');
        Route::get('{id}', 'Cms\Role\RoleController@getItemWithPermissions')
            ->where('id', '[0-9]+');
    });
    Route::apiResource('roles', 'Cms\Role\RoleController')->except(['show', 'create', 'edit', 'update']);


    // Permissions

    Route::group(['prefix' => 'permissions'], function() {
        Route::post('{id}', 'Cms\Permission\PermissionController@update')
            ->where('id', '[0-9]+');
    });
    Route::apiResource('permissions', 'Cms\Permission\PermissionController')->except(['create', 'edit', 'update']);


    // Store

    Route::group(['prefix' => 'store'], function() {

        // Deliveries
        Route::group(['prefix' => 'deliveries'], function() {
            Route::post('{id}', 'Cms\Delivery\DeliveryController@update')
                ->where('id', '[0-9]+');
            Route::get('{id}/publish', 'Cms\Delivery\DeliveryController@publish')
                ->where('id', '[0-9]+');
        });
        Route::apiResource('deliveries', 'Cms\Delivery\DeliveryController')->except(['create', 'edit', 'update']);

        // Orders
        Route::group(['prefix' => 'orders'], function() {
            Route::get('/', 'Cms\Order\OrderController@getItems');
            Route::get('/{id}', 'Cms\Order\OrderController@getItem');
            Route::get('/{id}/details', 'Cms\Order\OrderController@getItemDetails');
            Route::post('/{id}/status', 'Cms\Order\OrderController@changeStatus');
        });

        // OrderStatuses
        Route::get('order-statuses/{id}/publish', 'Cms\OrderStatus\OrderStatusController@publish')
            ->where('id', '[0-9]+');
        Route::apiResource('order-statuses', 'Cms\OrderStatus\OrderStatusController');

        // Carts
//        Route::apiResource('carts', 'Cms\Cart\CmsCartController');
    });
});
