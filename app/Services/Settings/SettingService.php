<?php

namespace App\Services\Settings;

use App\DTOs\SettingDTO;
use App\Models\Setting;
use App\Services\Interfaces\CacheService;
use App\Services\Settings\Handlers\CreateSettingHandler;
use App\Services\Settings\Repositories\SettingRepositoryInterface;
use App\Services\Traits\CacheClearable;

/**
 * Class SettingService
 * @package App\Services\Settings
 */
class SettingService implements CacheService
{
    use CacheClearable;

    const CACHE_TAG = 'SETTING';
    const URL_CALLBACK_BOT = 'url_callback_bot';

    /**
     * @var SettingRepositoryInterface
     */
    protected $repository;
    /**
     * @var CreateSettingHandler
     */
    private $createSettingHandler;

    /**
     * SettingService constructor.
     * @param SettingRepositoryInterface $repository
     * @param CreateSettingHandler $createSettingHandler
     */
    public function __construct(
        SettingRepositoryInterface $repository,
        CreateSettingHandler $createSettingHandler
    ) {
        $this->repository = $repository;
        $this->createSettingHandler = $createSettingHandler;
    }

    /**
     * @return array|string[]
     */
    public static function availableSettings(): array
    {
        return [
            static::URL_CALLBACK_BOT,
        ];
    }

    /**
     *
     */
    public function cacheWarm(): void
    {
        Setting::all()->each(function (Setting $setting): void {
            $this->getByKey($setting->key);
        });
    }

    /**
     * @param SettingDTO $DTO
     * @return Setting
     */
    public function store(SettingDTO $DTO): Setting
    {
        return $this->createSettingHandler->handle($DTO);
    }

    /**
     * @param string $key
     * @return Setting|null
     */
    public function getByKey(string $key): ?Setting
    {
        return $this->repository->getByKey($key);
    }
}
