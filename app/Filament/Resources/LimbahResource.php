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


class LimbahResource extends Resource
{
    protected static ?string $model = Limbah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->label('Customer')
                    ->required(),
                Forms\Components\TextInput::make('code_manifest')
                    ->label('Kode Manifest')
                    ->required(),
                Forms\Components\FileUpload::make('document_manifest')
                    ->label('Dokumen Manifest')
                    ->directory('limbahs/manifests')
                    ->required(),
                Forms\Components\TextInput::make('weight_limbah')
                    ->label('Berat Limbah')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('driver_id')
                    ->relationship('driver', 'name')
                    ->label('Driver')
                    ->required(),
                Forms\Components\Radio::make('pickup_1')
                    ->options([
                        'belum_dijemput' => 'Belum Dijemput',
                        'sudah_dijemput' => 'Sudah Dijemput',
                        'putus_kontrak' => 'Putus Kontrak',
                    ])
                    ->label('Pickup 1')
                    ->default('belum_dijemput'),
                Forms\Components\DatePicker::make('date_pickup_1')
                    ->label('Tanggal Penjemputan 1')
                    ->required(),
                Forms\Components\Radio::make('pickup_2')
                    ->options([
                        'belum_dijemput' => 'Belum Dijemput',
                        'sudah_dijemput' => 'Sudah Dijemput',
                        'putus_kontrak' => 'Putus Kontrak',
                    ])
                    ->label('Pickup 2')
                    ->default('belum_dijemput'),
                Forms\Components\DatePicker::make('date_pickup_2')
                    ->label('Tanggal Penjemputan 2')
                    ->required(),
                Forms\Components\Radio::make('pickup_3')
                    ->options([
                        'belum_dijemput' => 'Belum Dijemput',
                        'sudah_dijemput' => 'Sudah Dijemput',
                        'putus_kontrak' => 'Putus Kontrak',
                    ])
                    ->label('Pickup 3')
                    ->default('belum_dijemput'),
                Forms\Components\DatePicker::make('date_pickup_3')
                    ->label('Tanggal Penjemputan 3')
                    ->required(),
                Forms\Components\Radio::make('pickup_4')
                    ->options([
                        'belum_dijemput' => 'Belum Dijemput',
                        'sudah_dijemput' => 'Sudah Dijemput',
                        'putus_kontrak' => 'Putus Kontrak',
                    ])
                    ->label('Pickup 4')
                    ->default('belum_dijemput'),
                Forms\Components\DatePicker::make('date_pickup_3')
                    ->label('Tanggal Penjemputan 3')
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
                Tables\Columns\TextColumn::make('customer.name')->label('Customer'),
                Tables\Columns\TextColumn::make('code_manifest')->label('Kode Manifest'),
                Tables\Columns\TextColumn::make('weight_limbah')->label('Berat Limbah (kg)'),
                Tables\Columns\TextColumn::make('driver.name')->label('Driver'),
                Tables\Columns\TextColumn::make('pickup_1')->label('Pickup 1'),
                Tables\Columns\TextColumn::make('date_pickup_1')->label('Tanggal Penjemputan 1')->date(),
                Tables\Columns\TextColumn::make('pickup_2')->label('Pickup 2'),
                Tables\Columns\TextColumn::make('date_pickup_2')->label('Tanggal Penjemputan 2')->date(),

                Tables\Columns\TextColumn::make('pickup_3')->label('Pickup 3'),
                Tables\Columns\TextColumn::make('date_pickup_3')->label('Tanggal Penjemputan 3')->date(),

                Tables\Columns\TextColumn::make('pickup_4')->label('Pickup 4'),
                Tables\Columns\TextColumn::make('date_pickup_4')->label('Tanggal Penjemputan 4')->date(),

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
            //
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
