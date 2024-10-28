<?php

namespace App\Filament\Resources\PickUpDetailResource\Pages;

use App\Filament\Resources\PickUpDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPickUpDetails extends ListRecords
{
    protected static string $resource = PickUpDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
