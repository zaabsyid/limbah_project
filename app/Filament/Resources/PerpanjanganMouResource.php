<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerpanjanganMouResource\Pages;
use App\Filament\Resources\PerpanjanganMouResource\RelationManagers;
use App\Models\PerpanjanganMou;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PerpanjanganMouResource extends Resource
{
    protected static ?string $model = PerpanjanganMou::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('contract_period')
                    ->options([
                        '2' => '2 Tahun',
                        '5' => '5 Tahun',
                    ])
                    ->label('Periode Kontrak')
                    ->disabled(),
                Forms\Components\Repeater::make('renewals')
                    ->relationship('renewals')
                    ->schema([
                        Forms\Components\TextInput::make('year')->label('Tahun'),
                        Forms\Components\FileUpload::make('document_payment')->label('Bukti Pembayaran')->directory('renewals/documents'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'orange' => 'Belum Dibayar',
                                'green' => 'Sudah Dibayar',
                            ]),
                    ])->label('Perpanjangan Tahun'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')->label('Customer'),
                Tables\Columns\TextColumn::make('contract_period')->label('Periode'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
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
            'index' => Pages\ListPerpanjanganMous::route('/'),
            'create' => Pages\CreatePerpanjanganMou::route('/create'),
            'edit' => Pages\EditPerpanjanganMou::route('/{record}/edit'),
        ];
    }
}
