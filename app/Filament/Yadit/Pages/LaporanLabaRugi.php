<?php

namespace App\Filament\Yadit\Pages;

use App\Models\JournalEntry;
use BackedEnum;
use Filament\Pages\Page;

class LaporanLabaRugi extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-presentation-chart-line';
    protected static ?string $navigationLabel = 'Laporan Laba Rugi';
    protected string $view = 'filament.yadit.pages.laporan-laba-rugi';

    public function getLaporanData(): array
    {
        $pendapatan = JournalEntry::whereHas('account', fn($q) => $q->where('tipe', 'revenue'))->sum('nominal');
        $beban = JournalEntry::whereHas('account', fn($q) => $q->where('tipe', 'expense'))->sum('nominal');

        return [
            'pendapatan' => $pendapatan,
            'beban' => $beban,
            'laba_rugi' => $pendapatan - $beban,
        ];
    }
}