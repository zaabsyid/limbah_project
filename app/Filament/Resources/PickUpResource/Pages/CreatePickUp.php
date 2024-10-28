<?php

namespace App\Filament\Resources\PickUpResource\Pages;

use App\Filament\Resources\PickUpResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePickUp extends CreateRecord
{
    protected static string $resource = PickUpResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
