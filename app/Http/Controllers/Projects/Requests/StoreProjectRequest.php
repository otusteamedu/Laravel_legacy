<?php

namespace App\Http\Controllers\Projects\Requests;

use Carbon\Carbon;

class StoreProjectRequest extends UpdateProjectRequest
{

    public function getFormData()
    {
        $data = parent::getFormData();

        $data['created_at'] = Carbon::create()->subDay();

        return $data;
    }
}
