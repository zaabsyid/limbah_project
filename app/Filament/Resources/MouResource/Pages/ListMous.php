<?php

namespace App\Filament\Resources\MouResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use App\Filament\Resources\MouResource;
use Filament\Resources\Pages\ListRecords;

class ListMous extends ListRecords
{
    protected static string $resource = MouResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Download pdf')
                ->url(route('mou.download'))->openUrlInNewTab(),
            Actions\CreateAction::make(),
        ];
    }
}
