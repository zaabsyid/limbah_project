<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Billing;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BillingResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BillingResource\RelationManagers;

class BillingResource extends Resource
{
    protected static ?string $model = Billing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('document_payment')
                    ->label('Bukti Pembayaran')
                    ->directory('billings/documents')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'putus_kontrak' => 'Putus Kontrak',
                        'sudah_perpanjang' => 'Sudah Perpanjang',
                        'belum_diperpanjang' => 'Belum Diperpanjang',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')->label('Customer'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Tanggal'),
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
            'index' => Pages\ListBillings::route('/'),
            'create' => Pages\CreateBilling::route('/create'),
            'edit' => Pages\EditBilling::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
