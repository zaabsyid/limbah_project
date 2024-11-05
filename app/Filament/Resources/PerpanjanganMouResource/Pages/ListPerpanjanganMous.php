<?php

namespace App\Filament\Resources\PerpanjanganMouResource\Pages;

use App\Filament\Resources\PerpanjanganMouResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPerpanjanganMous extends ListRecords
{
    protected static string $resource = PerpanjanganMouResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
