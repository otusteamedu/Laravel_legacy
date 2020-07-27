<?php

namespace App\Http\Controllers\Admin\Settings;

use App\DTOs\SettingDTO;
use App\Http\Controllers\Admin\Settings\Requests\StoreSettingRequest;
use App\Http\Controllers\Controller;
use App\Services\Settings\SettingService;
use Illuminate\Http\RedirectResponse;

class SettingController extends Controller
{
    /**
     * @var SettingService
     */
    private $service;

    /**
     * SettingController constructor.
     * @param SettingService $service
     */
    public function __construct(SettingService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @param StoreSettingRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSettingRequest $request): RedirectResponse
    {
        $this->service->store(SettingDTO::fromArray($request->toArray()));

        return redirect()->back()
            ->with(['success' => __('messages.success_save')]);
    }
}
