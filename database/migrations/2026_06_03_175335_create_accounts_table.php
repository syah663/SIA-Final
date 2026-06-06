<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('kode_akun')->unique(); // Kolom untuk 111, 411, dll
            $table->string('nama_akun'); // Kolom untuk 'Kas Utama', dll
            $table->string('tipe'); // Kolom untuk tipe (asset, revenue, expense)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};