<?php

namespace App\Http\Controllers\Admin\Telegram;

use App\Http\Controllers\Controller;
use App\Services\Settings\SettingService;
use App\Services\Telegram\TelegramService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class TelegramController
 * @package App\Http\Controllers\Admin\Telegram
 */
class TelegramController extends Controller
{
    /**
     * @var SettingService
     */
    private $settingService;
    /**
     * @var TelegramService
     */
    private $service;

    /**
     * TelegramController constructor.
     * @param SettingService $settingService
     * @param TelegramService $service
     */
    public function __construct(SettingService $settingService, TelegramService $service)
    {
        parent::__construct();
        $this->settingService = $settingService;
        $this->service = $service;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('admin.telegram.setting', [
            'urlCallbackBot' => $this->settingService
                ->getByKey(SettingService::URL_CALLBACK_BOT)->value ?? '',
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function setWebhook(): RedirectResponse
    {
        $urlCallbackBot = $this->settingService->getByKey(SettingService::URL_CALLBACK_BOT);

        if ($urlCallbackBot) {
            $result = $this->service->setWebhook($urlCallbackBot->value);
        } else {
            $result = SettingService::URL_CALLBACK_BOT . ' not set';
        }

        return redirect()->route('admin.telegram.index')->with('status', $result);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function getWebhookInfo(Request $request): RedirectResponse
    {
        $result = $this->service->getWebhookInfo();

        return redirect()->route('admin.telegram.index')->with('status', $result);
    }
}
