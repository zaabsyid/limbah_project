<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LimbahResource\Pages;
use App\Filament\Resources\LimbahResource\RelationManagers;
use App\Models\Limbah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LimbahResource extends Resource
{
    protected static ?string $model = Limbah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('city')
                    ->label('City')
                    ->required(),
                Forms\Components\DatePicker::make('pickup_date')
                    ->label('Pickup Date')
                    ->required(),
                Forms\Components\TextInput::make('weight_kg')
                    ->label('Weight (kg)')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('manifest_code')
                    ->label('Manifest Code')
                    ->nullable(),
                Forms\Components\TextInput::make('team_name')
                    ->label('Team Name')
                    ->nullable(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'picked_up' => 'Picked Up',
                        'terminated' => 'Terminated',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('city')->label('City')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('pickup_date')->label('Pickup Date')->sortable(),
                Tables\Columns\TextColumn::make('weight_kg')->label('Weight (kg)'),
                Tables\Columns\TextColumn::make('status')->label('Status')->sortable(),
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
            'index' => Pages\ListLimbahs::route('/'),
            'create' => Pages\CreateLimbah::route('/create'),
            'edit' => Pages\EditLimbah::route('/{record}/edit'),
        ];
    }
}
