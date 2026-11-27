<?php

namespace App\Filament\Resources\Pages;

use Filament\Resources\Pages\ListRecords as BaseListRecords;

class ListRecords extends BaseListRecords
{
    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
