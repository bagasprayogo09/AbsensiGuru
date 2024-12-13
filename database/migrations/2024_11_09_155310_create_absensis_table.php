<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade'); // Menambahkan kolom user_id sebagai foreign key
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'tidak_hadir', 'izin']);
            $table->time('jam_masuk')->nullable(); // Menambahkan kolom jam_masuk
            $table->time('jam_keluar')->nullable(); // Menambahkan kolom jam_keluar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
