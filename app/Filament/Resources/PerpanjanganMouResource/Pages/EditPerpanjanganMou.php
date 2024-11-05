<?php

namespace App\Filament\Resources\PerpanjanganMouResource\Pages;

use App\Filament\Resources\PerpanjanganMouResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPerpanjanganMou extends EditRecord
{
    protected static string $resource = PerpanjanganMouResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
