<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\City;
use Filament\Tables;
use App\Models\Driver;
use App\Models\Limbah;
use App\Models\Province;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LimbahPerDriverExport;
use App\Exports\LimbahPerProvinceExport;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LimbahResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LimbahResource\RelationManagers;
use App\Filament\Resources\LimbahResource\RelationManagers\PenjemputanLimbahRelationManager;

class LimbahResource extends Resource
{
    protected static ?string $model = Limbah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = 'Limbah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->label('Customer')
                    ->required(),
                Forms\Components\Select::make('driver_id')
                    ->relationship('driver', 'name')
                    ->label('Driver')
                    ->required(),
                // Forms\Components\Repeater::make('pickups')
                //     ->schema([
                //         Forms\Components\Select::make('pickup_status')
                //             ->options([
                //                 'belum_dijemput' => 'Belum Dijemput',
                //                 'sudah_dijemput' => 'Sudah Dijemput',
                //                 'putus_kontrak' => 'Putus Kontrak',
                //             ])
                //             ->label('Status Penjemputan'),
                //     ]),
                Forms\Components\Select::make('province_id')
                    ->label('Province')
                    ->options(Province::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('city_id')
                    ->label('City')
                    ->options(City::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')->label('Customer Name'),
                Tables\Columns\TextColumn::make('customer.email')->label('Customer Email'),
                Tables\Columns\TextColumn::make('customer.nik')->label('Customer NIK'),
                Tables\Columns\TextColumn::make('driver.name')->label('Driver'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->headerActions([
                Action::make('Export per Province')
                    ->form([
                        Forms\Components\Select::make('province_id')
                            ->label('Select Province')
                            ->options(Province::all()->pluck('name', 'id'))
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        return Excel::download(new LimbahPerProvinceExport($data['province_id']), 'limbah_per_province.xlsx');
                    })
                    ->modalHeading('Export Limbah per Province'),

                Action::make('Export per Driver')
                    ->form([
                        Forms\Components\Select::make('driver_id')
                            ->label('Select Driver')
                            ->options(Driver::all()->pluck('name', 'id'))
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        return Excel::download(new LimbahPerDriverExport($data['driver_id']), 'limbah_per_driver.xlsx');
                    })
                    ->modalHeading('Export Limbah per Driver'),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('province_id')->label('Province')->relationship('province', 'name'),
                Tables\Filters\SelectFilter::make('driver_id')->label('Driver')->relationship('driver', 'name'),
            ]);;
    }

    public static function getRelations(): array
    {
        return [
            PenjemputanLimbahRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLimbahs::route('/'),
            'create' => Pages\CreateLimbah::route('/create'),
            'edit' => Pages\EditLimbah::route('/{record}/edit'),
        ];
    }
}
