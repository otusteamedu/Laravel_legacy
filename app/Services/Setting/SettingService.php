<?php

namespace App\Services\Setting;

use App\Models\Setting;
use App\Services\Setting\Repositories\SettingRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SettingService
{

    private $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function index()
    {

        return $this->settingRepository->index();
    }
    public function update($data)
    {
        return $this->settingRepository->update($data);
    }



}
