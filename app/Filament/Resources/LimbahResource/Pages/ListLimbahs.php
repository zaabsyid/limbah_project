<?php

namespace App\Filament\Resources\LimbahResource\Pages;

use App\Filament\Resources\LimbahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLimbahs extends ListRecords
{
    protected static string $resource = LimbahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
