<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MouResource\Pages;
use App\Filament\Resources\MouResource\RelationManagers;
use App\Models\Mou;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MouResource extends Resource
{
    protected static ?string $model = Mou::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_name')
                    ->label('Customer Name')
                    ->required(),
                Forms\Components\TextInput::make('customer_phone')
                    ->label('Customer Phone')
                    ->required(),
                Forms\Components\TextInput::make('customer_address')
                    ->label('Customer Address')
                    ->required(),
                Forms\Components\TextInput::make('npwp')
                    ->label('NPWP')
                    ->required(),
                Forms\Components\FileUpload::make('ktp')
                    ->label('KTP')
                    ->directory('uploads/ktp')
                    ->required(),
                Forms\Components\FileUpload::make('sip_str')
                    ->label('SIP/STR')
                    ->directory('uploads/sip_str')
                    ->required(),
                Forms\Components\TextInput::make('package')
                    ->label('Package')
                    ->required(),
                Forms\Components\FileUpload::make('owner_photo')
                    ->label('Owner Photo')
                    ->directory('uploads/owner_photos')
                    ->image(),
                Forms\Components\TextInput::make('city')
                    ->label('City')
                    ->required(),
                Forms\Components\Select::make('contract_period')
                    ->label('Contract Period')
                    ->options([
                        '2 years' => '2 Years',
                        '5 years' => '5 Years',
                    ])
                    ->default('2 years')
                    ->required(),
                Forms\Components\DatePicker::make('contract_end_date')
                    ->label('Contract End Date')
                    ->required()
                    ->default(now()->addYears(2)),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'final' => 'Final',
                    ])
                    ->default('draft')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_name')->label('Customer Name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('customer_phone')->label('Customer Phone'),
                Tables\Columns\TextColumn::make('city')->label('City')->sortable(),
                Tables\Columns\TextColumn::make('status')->label('Status'),
                Tables\Columns\TextColumn::make('contract_end_date')->label('Contract End Date')->sortable(),
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
