<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Relasi dari Transaksi ke detail Jurnal
    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }
}
