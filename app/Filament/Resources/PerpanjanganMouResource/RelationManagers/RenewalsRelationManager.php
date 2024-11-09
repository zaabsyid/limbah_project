<?php

namespace App\Filament\Resources\PerpanjanganMouResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RenewalsRelationManager extends RelationManager
{
    protected static string $relationship = 'renewals';

    protected static ?string $label = 'Perpanjangan Tahunan';

    protected static ?string $pluralLabel = 'Perpanjangan Tahunan';
    protected static ?string $singularLabel = 'Perpanjangan Tahunan';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('year')
                    ->label('Tahun')
                    ->disabled(),
                Forms\Components\DatePicker::make('due_date')
                    ->label('Tanggal Jatuh Tempo')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'orange' => 'Belum Dibayar',
                        'green' => 'Sudah Dibayar',
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('document_payment')
                    ->label('Bukti Pembayaran')
                    ->directory('renewals/documents'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('year')
            ->columns([
                Tables\Columns\TextColumn::make('year')->label('Tahun'),
                Tables\Columns\TextColumn::make('due_date')->label('Tanggal Jatuh Tempo')->date(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'orange' => 'belum_dibayar',
                        'green' => 'sudah_dibayar',
                    ])
                    ->formatStateUsing(function ($state) {
                        // Menyesuaikan label tampilan status
                        return match ($state) {
                            'orange' => 'Belum Dibayar',
                            'green' => 'Sudah DIbayar',
                            default => $state,
                        };
                    }),
                Tables\Columns\TextColumn::make('document_payment')
                    ->label('Dokumen Pembayaran')
                    ->formatStateUsing(fn($state) => $state ? basename($state) : 'N/A')
                    ->url(fn($record) => $record->document_payment ? asset('storage/' . $record->document_payment) : null, true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
