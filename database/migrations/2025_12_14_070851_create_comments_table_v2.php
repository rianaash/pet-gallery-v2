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
    Schema::dropIfExists('comments'); // Jaga-jaga hapus yg lama

    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('photo_id')->constrained()->cascadeOnDelete();

        // INI KUNCINYA:
        $table->foreignId('parent_id')
              ->nullable()              // Boleh kosong (kalau bukan balasan)
              ->constrained('comments') // Nyambung ke tabel ini sendiri
              ->cascadeOnDelete();      // Induk dihapus, anak ikut hilang

        $table->text('content');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
