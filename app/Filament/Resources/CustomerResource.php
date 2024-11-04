<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\City;
use Filament\Tables;
use App\Models\Customer;
use App\Models\Province;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerResource\RelationManagers;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Name'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label('Email'),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->required()
                    ->maxLength(15)
                    ->prefixIcon('heroicon-s-phone')
                    ->label('Phone'),
                Forms\Components\TextInput::make('occupation')
                    ->required()
                    ->maxLength(255)
                    ->label('Occupation'),
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('nik')
                            ->required()
                            ->label('NIK'),
                        Forms\Components\TextInput::make('str_sip')
                            ->required()
                            ->label('STR/SIP')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('npwp')
                            ->required()
                            ->label('NPWP')
                            ->maxLength(255),
                    ]),
                Forms\Components\Grid::make(1)
                    ->schema([
                        Forms\Components\Textarea::make('address')
                            ->required()
                            ->label('Address'),
                    ]),
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
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->label('Customer Image 1')
                    ->directory('customers/images'),
                Forms\Components\FileUpload::make('customer_image_2')
                    ->image()
                    ->imageEditor()
                    ->label('Customer Image 2')
                    ->directory('customers/images'),
                Forms\Components\FileUpload::make('customer_npwp_file')
                    ->label('Customer NPWP')
                    ->directory('customers/npwp'),
                Forms\Components\FileUpload::make('customer_ktp_file')
                    ->label('Customer KTP')
                    ->directory('customers/ktp'),
                Forms\Components\FileUpload::make('customer_str_sip_file')
                    ->label('Customer STR/SIP')
                    ->directory('customers/str-sip'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Name'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('occupation')->label('Occupation'),
                Tables\Columns\TextColumn::make('nik')->label('NIK'),
                Tables\Columns\TextColumn::make('province.name')->label('Province'),
                Tables\Columns\TextColumn::make('city.name')->label('City'),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
