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
        Schema::create('scramble_words', function (Blueprint $table) {
            $table->id();
            
            // Kata asli dan kata yang diacak
            $table->string('original_word');
            $table->string('scrambled_word');
            
            // Deskripsi ilmiah untuk pop-up edukasi setelah user menjawab
            $table->text('scientific_description');
            
            // Path file untuk gambar ilustrasi lahan basah (nullable jika opsional)
            $table->string('illustration_image')->nullable();
            
            // Tingkatan level menggunakan tipe data enum atau tinyInteger
            // 1: Beginner, 2: Intermediate, 3: Advanced
            $table->tinyInteger('level_tier')->default(1)->comment('1: Beginner, 2: Intermediate, 3: Advanced');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scramble_words');
    }
};