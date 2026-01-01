<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key ke tabel students
            $table->foreignId('student_id')
                  ->constrained('students')
                  ->onDelete('cascade');
                  
            $table->date('date');
            $table->enum('status', ['hadir', 'telat', 'izin', 'sakit', 'alpa']);
            
            // Mencegah duplikasi presensi siswa di hari yang sama
            $table->unique(['student_id', 'date']);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};