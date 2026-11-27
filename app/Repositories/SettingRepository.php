<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return Setting::class;
    }

    public function getSettings(): Setting
    {
        return Setting::getInstance();
    }
}
