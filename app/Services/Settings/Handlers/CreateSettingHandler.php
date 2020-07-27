<?php

namespace App\Services\Settings\Handlers;

use App\DTOs\SettingDTO;
use App\Models\Setting;

/**
 * Class CreateSettingHandler
 * @package App\Services\Settings\Handlers
 */
class CreateSettingHandler extends BaseHandler
{
    /**
     * @param SettingDTO $DTO
     * @return Setting
     */
    public function handle(SettingDTO $DTO): Setting
    {
        return $this->repository->store($DTO);
    }
}
