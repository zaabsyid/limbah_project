<?php

namespace App\Filament\Resources\LimbahResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenjemputanLimbahRelationManager extends RelationManager
{
    protected static string $relationship = 'penjemputanLimbah';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code_manifest')
                    ->label('Kode Manifest')
                    ->required(),
                Forms\Components\FileUpload::make('document_manifest')
                    ->label('Dokumen Manifest')
                    ->directory('limbahs/manifests')
                    ->required(),
                Forms\Components\TextInput::make('weight_limbah')
                    ->label('Berat Limbah')
                    ->numeric()
                    ->required(),
                // Forms\Components\Radio::make('pickup')
                //     ->options([
                //         'belum_dijemput' => 'Belum Dijemput',
                //         'sudah_dijemput' => 'Sudah Dijemput',
                //         'siap_dijemput' => 'Siap Dijemput',
                //         'putus_kontrak' => 'Putus Kontrak',
                //     ])
                //     ->label('Pickup 1')
                //     ->default('belum_dijemput'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('pickup')
            ->columns([
                Tables\Columns\BadgeColumn::make('pickup')
                    ->label('Pickup')
                    ->colors([
                        'primary' => 'belum_dijemput',
                        'success' => 'siap_dijemput',
                        'success' => 'sudah_dijemput',
                        'danger' => 'putus_kontrak',
                    ])
                    ->formatStateUsing(function ($state) {
                        // Menyesuaikan label tampilan status
                        return match ($state) {
                            'belum_dijemput' => 'Belum Dijemput',
                            'siap_dijemput' => 'Siap Dijemput',
                            'sudah_dijemput' => 'Sudah Dijemput',
                            'putus_kontrak' => 'Putus Kontrak',
                            default => $state,
                        };
                    }),
                Tables\Columns\TextColumn::make('code_manifest')->label('Kode Manifest'),
                Tables\Columns\TextColumn::make('weight_limbah')->label('Berat Limbah (kg)'),
                Tables\Columns\TextColumn::make('date_pickup')->label('Tanggal Penjemputan')->date(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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