<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Membuat tabel teachers
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama guru
            $table->string('nip')->unique(); // Nomor Induk Pegawai (unik)
            $table->string('subject'); // Mata pelajaran yang diajar
            $table->string('phone')->nullable(); // Nomor telepon (opsional)
            $table->string('email')->unique()->nullable(); // Email (unik, opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    // Menghapus tabel teachers jika ada
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};