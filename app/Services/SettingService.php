<?php

namespace App\Services;

use App\Models\Setting;

class SettingService extends BaseService
{
    protected function getModelClass(): string
    {
        return Setting::class;
    }

    public function getSettings(): Setting
    {
        return Setting::getInstance();
    }

    public function updateSettings(array $data): Setting
    {
        $settings = $this->getSettings();

        return $this->update($settings, $data);
    }
}
