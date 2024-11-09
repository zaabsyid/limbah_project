<?php

namespace App\Filament\Resources;

use App\Models\Mou;
use Filament\Forms;
use App\Models\City;
use Filament\Tables;
use App\Models\Customer;
use App\Models\Province;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Exports\MousExport;
use App\Imports\MousImport;
use Illuminate\Support\Arr;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MouResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MouResource\RelationManagers;

class MouResource extends Resource
{
    protected static ?string $model = Mou::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = 'MoU';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('mou_number')
                    ->required()
                    ->maxLength(255)
                    ->label('MOU Number'),
                Forms\Components\Select::make('customer_id')
                    ->label('Customer')
                    ->options(Customer::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
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
                Forms\Components\Select::make('contract_period')
                    ->label('Contract Period')
                    ->options([
                        '2' => '2 Years',
                        '5' => '5 Years',
                    ])
                    ->required(),
                // Forms\Components\DatePicker::make('contract_end_date')
                //     ->label('Contract End Date')
                //     ->required(),
                Forms\Components\Select::make('mou_status_file')
                    ->label('MOU Status File')
                    ->options([
                        'draft' => 'Draft',
                        'file' => 'File',
                    ])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('MOU Status')
                    ->options([
                        'putus_kontrak' => 'Putus Kontrak',
                        'sudah_perpanjang' => 'Sudah Diperpanjang',
                        'belum_diperpanjang' => 'Belum Diperpanjang',
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('customer_materai_1')
                    ->label('Customer Materai 1')
                    ->directory('mous/materai')
                    ->image()
                    ->nullable(),
                Forms\Components\FileUpload::make('customer_materai_2')
                    ->label('Customer Materai 2')
                    ->directory('mous/materai')
                    ->image()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // gpt
            // ->actions([
            //     Tables\Actions\Action::make('Export Excel')
            //         ->button()
            //         ->action(function () {
            //             return Excel::download(new MousExport, 'mou.xlsx');
            //         }),
            //     Tables\Actions\Action::make('Import Excel')
            //         ->form([
            //             FileUpload::make('file')->required(),
            //         ])
            //         ->action(function (array $data) {
            //             Excel::import(new MousImport, $data['file']);
            //             Notification::make()
            //                 ->title('Import berhasil!')
            //                 ->success()
            //                 ->send();
            //         }),
            // ])
            ->headerActions([])
            ->columns([
                Tables\Columns\TextColumn::make('mou_number')->label('MOU Number'),
                Tables\Columns\TextColumn::make('customer.name')->label('Customer'),
                Tables\Columns\TextColumn::make('status')->label('Status Mou'),
                Tables\Columns\TextColumn::make('mou_status_file')->label('Status File'),
                Tables\Columns\TextColumn::make('province.name')->label('Province'),
                Tables\Columns\TextColumn::make('city.name')->label('City'),
                Tables\Columns\TextColumn::make('contract_period')->label('Contract Period'),
                Tables\Columns\TextColumn::make('contract_end_date')->label('End Date')->date(),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListMous::route('/'),
            'create' => Pages\CreateMou::route('/create'),
            'edit' => Pages\EditMou::route('/{record}/edit'),
        ];
    }
}
