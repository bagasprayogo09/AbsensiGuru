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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('hari');
            $table->integer('jumlah_jam'); // Menyimpan jumlah jam mengajar
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajarans')->onDelete('cascade'); // Relasi ke mata pelajaran
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade'); // Relasi ke users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
