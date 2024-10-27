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
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MouResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MouResource\RelationManagers;

class MouResource extends Resource
{
    protected static ?string $model = Mou::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                Forms\Components\TextInput::make('customer_name')
                    ->label('Customer Name')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\TextInput::make('customer_nik')
                    ->label('Customer NIK')
                    ->maxLength(20)
                    ->nullable(),
                Forms\Components\Textarea::make('customer_address')
                    ->label('Customer Address')
                    ->nullable(),
                Forms\Components\TextInput::make('customer_occupation')
                    ->label('Customer Occupation')
                    ->maxLength(255)
                    ->nullable(),
                Forms\Components\FileUpload::make('customer_ktp_image')
                    ->label('Customer KTP Image')
                    ->directory('mous/ktp_images')
                    ->image()
                    ->nullable(),
                Forms\Components\FileUpload::make('customer_npwp_image')
                    ->label('Customer NPWP Image')
                    ->directory('mous/npwp_images')
                    ->image()
                    ->nullable(),
                Forms\Components\FileUpload::make('customer_sip_str_image')
                    ->label('Customer SIP/STR Image')
                    ->directory('mous/sip_str_images')
                    ->image()
                    ->nullable(),
                Forms\Components\FileUpload::make('customer_image_1')
                    ->label('Customer Image 1')
                    ->directory('mous/images')
                    ->image()
                    ->nullable(),
                Forms\Components\FileUpload::make('customer_image_2')
                    ->label('Customer Image 2')
                    ->directory('mous/images')
                    ->image()
                    ->nullable(),
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
                Forms\Components\Select::make('mou_status')
                    ->label('MOU Status')
                    ->options([
                        'draft' => 'Draft',
                        'file' => 'File',
                    ])
                    ->default('draft')
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
                    ->default('2')
                    ->required(),
                Forms\Components\DatePicker::make('contract_end_date')
                    ->label('Contract End Date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mou_number')->label('MOU Number'),
                Tables\Columns\TextColumn::make('customer.name')->label('Customer'),
                Tables\Columns\TextColumn::make('mou_status')->label('Status')->enum([
                    'draft' => 'Draft',
                    'file' => 'File',
                ]),
                Tables\Columns\TextColumn::make('province.name')->label('Province'),
                Tables\Columns\TextColumn::make('city.name')->label('City'),
                Tables\Columns\TextColumn::make('contract_period')->label('Contract Period')->enum([
                    '2' => '2 Years',
                    '5' => '5 Years',
                ]),
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
