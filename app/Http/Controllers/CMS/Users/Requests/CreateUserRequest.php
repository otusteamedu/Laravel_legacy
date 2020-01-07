<?php

namespace App\Http\Controllers\CMS\Users\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/* получи предопределённые списки значений из config/shop.php
define('USER_SOURCES', config('shop.sources'));
define('USER_TYPES', config('shop.types'));
define('USER_OPERATORS', config('shop.operators'));*/

class CreateUserRequest extends UpdateUserRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//БЫЛО false;
    }
}
