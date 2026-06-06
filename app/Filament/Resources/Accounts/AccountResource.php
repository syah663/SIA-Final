<?php

namespace App\Filament\Resources\Accounts;

use App\Filament\Resources\Accounts\Pages\CreateAccount;
use App\Filament\Resources\Accounts\Pages\EditAccount;
use App\Filament\Resources\Accounts\Pages\ListAccounts;
use App\Models\Account;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;
    
    // INI YANG DIPERBAIKI: Menyesuaikan tipe data icon dengan standar Filament baru
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Bagan Akun';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('kode_akun')
                ->required()
                ->unique(ignoreRecord: true)
                ->label('Kode Akun'),
            TextInput::make('nama_akun')
                ->required()
                ->label('Nama Akun'),
            Select::make('tipe')
                ->options([
                    'asset' => 'Asset (Harta)',
                    'liability' => 'Liability (Kewajiban)',
                    'equity' => 'Equity (Modal)',
                    'revenue' => 'Revenue (Pendapatan)',
                    'expense' => 'Expense (Beban)',
                ])
                ->required()
                ->label('Tipe Akun'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('kode_akun')->searchable()->sortable(),
            TextColumn::make('nama_akun')->searchable(),
            TextColumn::make('tipe')->badge(),
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
            'index' => ListAccounts::route('/'),
            'create' => CreateAccount::route('/create'),
            'edit' => EditAccount::route('/{record}/edit'),
        ];
    }
}