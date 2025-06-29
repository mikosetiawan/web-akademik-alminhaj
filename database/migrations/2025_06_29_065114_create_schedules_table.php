<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Membuat tabel schedules
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); // ID guru dengan relasi ke tabel teachers
            $table->foreignId('subject_id')->constrained()->onDelete('cascade'); // Mata pelajaran
            $table->enum('day', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']); // Hari dalam seminggu
            $table->time('start_time'); // Waktu mulai
            $table->time('end_time'); // Waktu selesai
            $table->string('classroom')->nullable(); // Ruang kelas (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    // Menghapus tabel schedules jika ada
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};