<?php

namespace App\Filament\Resources\PickUpDetailResource\Pages;

use App\Filament\Resources\PickUpDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePickUpDetail extends CreateRecord
{
    protected static string $resource = PickUpDetailResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
