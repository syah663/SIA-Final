<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    use HasFactory;

    // Mengizinkan pengisian data masal untuk keamanan
    protected $fillable = [
        'transaction_id', 
        'account_id', 
        'tipe', 
        'nominal'
    ];

    // INI DIA JEMBATANNYA: Menghubungkan Jurnal ke Bagan Akun
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    // Menghubungkan Jurnal ke Transaksi Utama
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}