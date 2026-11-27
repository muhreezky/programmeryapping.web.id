<?php

namespace App\Filament\Resources\Pages;

use Filament\Resources\Pages\EditRecord as BaseEditRecord;

class EditRecord extends BaseEditRecord
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
