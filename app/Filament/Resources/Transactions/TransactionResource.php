<?php

namespace App\Filament\Resources\Transactions;

use App\Filament\Resources\Transactions\Pages\CreateTransaction;
use App\Filament\Resources\Transactions\Pages\EditTransaction;
use App\Filament\Resources\Transactions\Pages\ListTransactions;
use App\Models\Transaction;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Form;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;
    
    // INI YANG DIPERBAIKI: Menyesuaikan tipe data icon dengan standar Filament baru
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Transaksi Jurnal';

    public static function form(Form $form): orm
    {
        return $form
            ->schema([
                DatePicker::make('tanggal')
                    ->required(),
                    
                TextInput::make('no_referensi')
                    ->label('No. Referensi (Opsional)'),
                    
                Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull(),
                
                Repeater::make('journalEntries')
                    ->relationship()
                    ->schema([
                        Select::make('account_id')
                            ->relationship('account', 'nama_akun')
                            ->required()
                            ->searchable()
                            ->label('Pilih Akun'),
                            
                        Select::make('tipe')
                            ->options([
                                'debit' => 'Debit',
                                'kredit' => 'Kredit',
                            ])
                            ->required()
                            ->label('Posisi'),
                            
                        TextInput::make('nominal')
                            ->numeric()
                            ->required()
                            ->prefix('Rp'),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->addActionLabel('Tambah Baris Jurnal')
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('tanggal')->date()->sortable(),
            TextColumn::make('referensi')->searchable(),
            TextColumn::make('deskripsi')->limit(50),
        ])
        ->filters([])
        ->actions([
            EditAction::make(),
        ])
        ->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getRelations(): array 
    { 
        return []; 
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTransactions::route('/'),
            'create' => CreateTransaction::route('/create'),
            'edit' => EditTransaction::route('/{record}/edit'),
        ];
    }
}