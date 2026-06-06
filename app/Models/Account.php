<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    // Buka gembok agar kolom ini bisa diisi
    protected $fillable = [
        'kode_akun',
        'nama_akun',
        'tipe',
    ];

    // Relasi: Satu akun bisa memiliki banyak jurnal transaksi
    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }
}