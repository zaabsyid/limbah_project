<?php

namespace App\Filament\Resources\PickUpDetailResource\Pages;

use App\Filament\Resources\PickUpDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPickUpDetail extends EditRecord
{
    protected static string $resource = PickUpDetailResource::class;

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
