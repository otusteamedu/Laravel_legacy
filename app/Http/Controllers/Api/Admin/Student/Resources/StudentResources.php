<?php
namespace App\Http\Controllers\Api\Admin\Student\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Student\StudentService;

/**
 * Created by PhpStorm.
 * User: Rom
 * Date: 16.05.2020
 * Time: 10:26
 */
class StudentResources extends JsonResource
{
    /**
     * IoC не работет, поэтому так
     * @return StudentService
     */
    private function getStudentService()
    {
        return app()->make(StudentService::class);
    }

    public function toArray($request)
    {

//        $this->getStudentService()->all();

        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

}