<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Membuat tabel students
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama siswa
            $table->string('nis')->unique(); // Nomor Induk Siswa (unik)
            $table->string('class'); // Kelas siswa
            $table->date('birth_date')->nullable(); // Tanggal lahir (opsional)
            $table->text('address')->nullable(); // Alamat (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    // Menghapus tabel students jika ada
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};