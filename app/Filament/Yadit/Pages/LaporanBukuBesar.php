<?php

namespace App\Filament\Yadit\Pages;

use App\Models\Account;
use BackedEnum; 
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class LaporanBukuBesar extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Buku Besar';
    
    // INI YANG DIPERBAIKI: Kata 'static' dihapus dari sini
    protected string $view = 'filament.yadit.pages.laporan-buku-besar';

    public function table(Table $table): Table
    {
        return $table
            ->query(Account::query())
            ->columns([
                TextColumn::make('kode_akun')->label('Kode Akun')->sortable(),
                TextColumn::make('nama_akun')->label('Nama Akun')->searchable(),
                TextColumn::make('tipe')->label('Tipe Akun')->badge(),
            ]);
    }
}