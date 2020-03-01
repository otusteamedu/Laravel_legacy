<?php

namespace App\Services\Cms\Localization;

use App;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LocalizationService
{
    /** @var string[]  */
    protected const LANGS = [
        'ru',
        'en',
    ];

    public function __construct()
    {
    }

    public function setLocale(Request $request): void
    {
        try {
            $locale = $this->getLocale($request);

            $this->validateLocale($locale);

            App::setLocale($locale);

        } catch (\Throwable $exception) {
            Log::notice(__('log.notice.setLocale'), [
                'exception' => $exception->getMessage(),
            ]);
            abort(404);
        }
    }

    /**
     * @param Request $request
     * @return string|null
     */
    protected function getLocale(Request $request): ?string
    {
        return $request->route('locale');
    }

    /**
     * @param string $locale
     * @throws \Exception
     */
    protected function validateLocale(string $locale): void
    {
        $collection = collect(self::LANGS);

        if ($collection->search($locale) === false) {
            throw new \Exception(__('log.exception.locale') . $locale);
        }
    }
}