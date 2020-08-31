<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Сайт онлайн-фильмов",
     *      description="API",
     *      @OA\Contact(
     *          email="sckat@yandex.ru"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url= L5_SWAGGER_CONST_HOST,
     *      description="API Server"
     * )
     *
     *
    */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
