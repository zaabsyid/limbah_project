<?php

namespace App\Filament\Resources\PickUpResource\Pages;

use App\Filament\Resources\PickUpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPickUps extends ListRecords
{
    protected static string $resource = PickUpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
