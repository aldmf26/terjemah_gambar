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
        Schema::create('scramble_attempts', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Data performa permainan
            $table->integer('score')->default(0);
            $table->integer('remaining_time')->comment('Sisa waktu pengerjaan dalam detik');
            
            // Status hasil permainan
            $table->enum('status', ['win', 'lose']);
            
            // Mode permainan (misal: 'arcade', 'time_attack', 'campaign')
            $table->string('game_mode')->default('default');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scramble_attempts');
    }
};