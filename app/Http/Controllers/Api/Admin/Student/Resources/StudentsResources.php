<?php
namespace App\Http\Controllers\Api\Admin\Student\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Created by PhpStorm.
 * User: Rom
 * Date: 16.05.2020
 * Time: 10:26
 */
class StudentsResources extends ResourceCollection
{

    public function toArray($request){
        return [
          'data'=>StudentResources::collection($this),
          'count'=>$this->count(),
        ];
    }

}