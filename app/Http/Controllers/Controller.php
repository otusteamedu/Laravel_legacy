<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @SWG\Swagger(
 *   @SWG\Info(
 *     title="Онлайн кинотеатр",
 *     version="1.0",
 *     description="API для сайта фильмов",
 *     @SWG\Contact(
 *         email="sckat@yandex.ru"
 *     )
 *   )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
