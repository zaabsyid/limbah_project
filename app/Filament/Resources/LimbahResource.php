<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\City;
use Filament\Tables;
use App\Models\Limbah;
use App\Models\Province;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KategoriLimbah;
use Filament\Resources\Resource;
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
                Forms\Components\Select::make('id_category')
                    ->label('Category')
                    ->relationship('kategori', 'name')
                    ->options(KategoriLimbah::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->label('Code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('unit')
                    ->label('Unit')
                    ->required()
                    ->maxLength(100),
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
                Tables\Columns\TextColumn::make('kategori.name')->label('Category')->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')->label('Code')->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('price')->label('Price')->money('IDR')->sortable(),
                Tables\Columns\TextColumn::make('unit')->label('Unit')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('kategori', 'name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListLimbahs::route('/'),
            'create' => Pages\CreateLimbah::route('/create'),
            'edit' => Pages\EditLimbah::route('/{record}/edit'),
        ];
    }
}
