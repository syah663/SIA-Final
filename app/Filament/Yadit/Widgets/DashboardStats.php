<?php

namespace App\Filament\Yadit\Widgets;

use App\Models\Account;
use App\Models\JournalEntry;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        $rev = JournalEntry::whereHas('account', fn($q) => $q->where('tipe', 'revenue'))->sum('nominal');
        $exp = JournalEntry::whereHas('account', fn($q) => $q->where('tipe', 'expense'))->sum('nominal');
        
        $kas = JournalEntry::whereHas('account', fn($q) => $q->where('nama_akun', 'like', '%Kas%'))
            ->selectRaw("SUM(CASE WHEN tipe = 'debit' THEN nominal ELSE -nominal END) as saldo")
            ->value('saldo');

        return [
            Stat::make('Posisi Kas Saat Ini', 'Rp ' . number_format($kas ?? 0, 0, ',', '.'))
                ->description('Total saldo di akun Kas')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Laba/Rugi Bersih', 'Rp ' . number_format($rev - $exp, 0, ',', '.'))
                ->description('Performa keuangan periode ini')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color($rev - $exp >= 0 ? 'success' : 'danger'),

            Stat::make('Jumlah Bagan Akun', Account::count() . ' Akun')
                ->description('Tipe akun yang terdaftar')
                ->descriptionIcon('heroicon-m-folder-open'),
        ];
    }
}