<?php

namespace App\Filament\Resources\KategoriLimbahResource\Pages;

use App\Filament\Resources\KategoriLimbahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriLimbah extends EditRecord
{
    protected static string $resource = KategoriLimbahResource::class;

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
