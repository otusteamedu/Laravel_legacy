<?php
/**
 * Description of Model.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model as BaseModel;
use Watson\Rememberable\Rememberable;

class Model extends BaseModel
{

    use Rememberable;

}