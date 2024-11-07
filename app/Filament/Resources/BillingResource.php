<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Billing;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BillingResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BillingResource\RelationManagers;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class BillingResource extends Resource
{
    protected static ?string $model = Billing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->label('Customer')
                    ->disabled()
                    ->required(),
                Forms\Components\FileUpload::make('document_payment')
                    ->label('Bukti Pembayaran')
                    ->directory('billings/documents')
                    ->required()
                    ->preserveFilenames() // Pastikan untuk menyimpan nama file asli
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file) {
                        return $file->getClientOriginalName(); // Menyimpan hanya nama file
                    }),
                Forms\Components\Select::make('status')
                    ->options([
                        'putus_kontrak' => 'Putus Kontrak',
                        'sudah_perpanjang' => 'Sudah Perpanjang',
                        'belum_diperpanjang' => 'Belum Diperpanjang',
                    ])
                    ->required()
                    ->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')->label('Customer'),
                Tables\Columns\TextColumn::make('customer.email')->label('Customer Email'),
                Tables\Columns\TextColumn::make('customer.nik')->label('Customer NIK'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => 'belum_diperpanjang',  // Warna oren untuk "belum_diperpanjang"
                        'success' => 'sudah_diperpanjang',  // Warna hijau untuk "sudah_diperpanjang"
                        'danger' => 'putus_kontrak',        // Warna merah untuk "putus_kontrak"
                    ])
                    ->formatStateUsing(function ($state) {
                        // Menyesuaikan label tampilan status
                        return match ($state) {
                            'belum_diperpanjang' => 'Belum Diperpanjang',
                            'sudah_diperpanjang' => 'Sudah Diperpanjang',
                            'putus_kontrak' => 'Putus Kontrak',
                            default => $state,
                        };
                    }),
                Tables\Columns\TextColumn::make('document_payment')
                    ->label('Nama File')
                    ->formatStateUsing(fn($state) => basename($state)),
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
