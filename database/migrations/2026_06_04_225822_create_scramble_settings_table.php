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
        Schema::create('scramble_settings', function (Blueprint $table) {
            $table->id();
            
            // Konfigurasi aset audio dan visual
            $table->string('background_music')->nullable()->comment('Path file .mp3');
            $table->string('background_image')->nullable()->comment('Path gambar latar belakang wetland');
            
            // Parameter gameplay
            $table->integer('timer_duration')->default(60)->comment('Durasi waktu dalam hitungan detik');
            
            // Parameter batas unlock level
            $table->integer('min_score_to_unlock_intermediate')->default(100);
            $table->integer('min_score_to_unlock_advanced')->default(250);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scramble_settings');
    }
};