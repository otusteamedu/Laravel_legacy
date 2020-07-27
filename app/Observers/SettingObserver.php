<?php

namespace App\Observers;

use App\Models\Setting;
use App\Services\Settings\SettingService;

class SettingObserver
{
    /**
     * @var SettingService
     */
    private $service;

    public function __construct(SettingService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the setting "created" event.
     *
     * @param Setting $setting
     * @return void
     */
    public function created(Setting $setting)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the setting "updated" event.
     *
     * @param Setting $setting
     * @return void
     */
    public function updated(Setting $setting)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the setting "deleted" event.
     *
     * @param Setting $setting
     * @return void
     */
    public function deleted(Setting $setting)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the setting "restored" event.
     *
     * @param Setting $setting
     * @return void
     */
    public function restored(Setting $setting)
    {
        $this->service->clearCache();
    }

    /**
     * Handle the setting "force deleted" event.
     *
     * @param Setting $setting
     * @return void
     */
    public function forceDeleted(Setting $setting)
    {
        $this->service->clearCache();
    }
}
