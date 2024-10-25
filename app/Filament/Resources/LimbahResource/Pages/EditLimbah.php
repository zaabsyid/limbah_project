<?php

namespace App\Filament\Resources\LimbahResource\Pages;

use App\Filament\Resources\LimbahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLimbah extends EditRecord
{
    protected static string $resource = LimbahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
