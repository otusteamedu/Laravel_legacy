<?php


namespace App\Helpers;


class JsonResponseHelper
{
    /**
     * Добавляем заголовки и кодировку utf-8 к ответу
     *
     * @param $response
     * @param $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function getResponseWithHeaders($response, $status)
    {
        return response()->json($response, $status, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }
}