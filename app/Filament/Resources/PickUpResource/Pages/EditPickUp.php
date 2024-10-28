<?php

namespace App\Filament\Resources\PickUpResource\Pages;

use App\Filament\Resources\PickUpResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPickUp extends EditRecord
{
    protected static string $resource = PickUpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
