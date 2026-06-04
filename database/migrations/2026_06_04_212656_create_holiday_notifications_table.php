<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('holiday_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama hari besar (contoh: "Hari Raya Idul Fitri")
            $table->date('start_date'); // Tanggal mulai tayang
            $table->date('end_date'); // Tanggal akhir tayang
            $table->string('icon_type'); // Jenis ikon (ketupat, merdeka, bintang, dll)
            $table->integer('display_duration')->default(5); // Durasi tampil (detik)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('holiday_notifications');
    }
};