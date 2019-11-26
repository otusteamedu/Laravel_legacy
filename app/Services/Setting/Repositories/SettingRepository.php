<?php

namespace App\Services\Setting\Repositories;

use App\Models\Setting;
use DB;

class SettingRepository
{

    public function index()
    {
        return Setting::find(1);
    }

    public function update($data)
    {
        if (Setting::where('id', 1)->update(self::getArray($data))) {
            return Setting::find(1);
        }
        return 0;
    }
    public function getArray($data)
    {
        $array = [];
        if (isset($data['name'])) {
            $array['name'] = $data['name'];
        }
        return $array;
    }
}
