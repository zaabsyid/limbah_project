<?php

namespace App\Filament\Resources;

use App\Models\Mou;
use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PerpanjanganMou;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PerpanjanganMouResource\Pages;
use App\Filament\Resources\PerpanjanganMouResource\RelationManagers;
use App\Filament\Resources\PerpanjanganMouResource\RelationManagers\RenewalsRelationManager;

class PerpanjanganMouResource extends Resource
{
    protected static ?string $model = PerpanjanganMou::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $pluralLabel = 'Perpanjangan MoU';

    protected static ?string $navigationGroup = 'Waste & MoU Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mou_id')
                    ->label('MoU')
                    ->options(Mou::all()->pluck('mou_number', 'id'))
                    ->searchable()
                    ->required(),

                // Forms\Components\Toggle::make('notified')
                //     ->label('Notifikasi Terkirim')
                //     ->default(false),

                // Forms\Components\Select::make('package')
                //     ->options([
                //         '2' => '2 Tahun',
                //         '5' => '5 Tahun',
                //     ])
                //     ->label('Paket Periode Kontrak'),

                // Forms\Components\Repeater::make('renewals')
                //     ->relationship('renewals')
                //     ->schema([
                //         Forms\Components\TextInput::make('year')->label('Tahun'),
                //         Forms\Components\FileUpload::make('document_payment')->label('Bukti Pembayaran')->directory('renewals/documents'),
                //         Forms\Components\Select::make('status')
                //             ->options([
                //                 'orange' => 'Belum Dibayar',
                //                 'green' => 'Sudah Dibayar',
                //             ]),
                //     ])
                //     ->label('Perpanjangan Tahun')
                //     ->visible(fn($get) => $get('contract_period') === '5'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('mou.mou_number')
                    ->label('MoU'),
                Tables\Columns\TextColumn::make('mou.customer.name')
                    ->label('Customer'),
                Tables\Columns\TextColumn::make('mou.contract_period')
                    ->label('Periode Kontrak')
                    ->formatStateUsing(fn($state) => $state == '5' ? '5 Tahun' : '2 Tahun'),
                // Tables\Columns\IconColumn::make('notified')
                //     ->label('Notifikasi Terkirim'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('contract_period')
                    ->label('Periode Kontrak')
                    ->relationship('mou', 'contract_period')
                    ->options([
                        '2' => '2 Tahun',
                        '5' => '5 Tahun',
                    ]),
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
            RenewalsRelationManager::class
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
