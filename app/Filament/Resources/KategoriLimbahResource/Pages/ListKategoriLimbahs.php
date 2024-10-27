<?php

namespace App\Filament\Resources\KategoriLimbahResource\Pages;

use App\Filament\Resources\KategoriLimbahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriLimbahs extends ListRecords
{
    protected static string $resource = KategoriLimbahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
