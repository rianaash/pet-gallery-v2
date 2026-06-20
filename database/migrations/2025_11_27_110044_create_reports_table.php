<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('reports', function (Blueprint $table) {
        $table->id();
        
        // 1. Ini untuk PELAPOR (Sesuai error kamu sebelumnya: reporter_user_id)
        // Kita harus kasih tau kalau ini connect ke tabel 'users'
        $table->foreignId('reporter_user_id')->constrained('users')->cascadeOnDelete(); 
        
        // 2. Ini untuk FOTO YANG DILAPORKAN (Sesuai error sekarang: photo_id)
        // Pastikan baris ini ADA!
        $table->foreignId('reported_photo_id')->constrained('photos')->cascadeOnDelete();
        
        $table->string('reason');
        $table->text('description')->nullable();
        $table->enum('status', ['pending', 'resolved', 'dismissed'])->default('pending');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};