<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        // Quiz 1: Bahasa Inggris Dasar
        $quiz1 = Quiz::create([
            'title' => 'Bahasa Inggris Dasar',
            'description' => 'Quiz tentang kata dasar bahasa Inggris.',
            'status' => 'active',
            'created_by' => 1 // pastikan user dengan ID 1 ada
        ]);

        // Tambah soal Multiple Choice
        $q1 = $quiz1->questions()->create([
            'question_text' => 'Apa arti kata "Apple" dalam bahasa Indonesia?',
            'question_type' => 'multiple_choice'
        ]);

        $q1->options()->createMany([
            ['option_text' => 'Apel', 'is_correct' => true],
            ['option_text' => 'Pisang', 'is_correct' => false],
            ['option_text' => 'Jeruk', 'is_correct' => false],
            ['option_text' => 'Mangga', 'is_correct' => false],
        ]);

        // Tambah soal True/False
        $q2 = $quiz1->questions()->create([
            'question_text' => '"Dog" artinya Kucing.',
            'question_type' => 'true_false'
        ]);

        $q2->options()->createMany([
            ['option_text' => 'True', 'is_correct' => false],
            ['option_text' => 'False', 'is_correct' => true],
        ]);

        // Quiz 2: Matematika Dasar
        $quiz2 = Quiz::create([
            'title' => 'Matematika Dasar',
            'description' => 'Tes penjumlahan dan pengurangan sederhana.',
            'status' => 'active',
            'created_by' => 1
        ]);

        $q3 = $quiz2->questions()->create([
            'question_text' => 'Hasil dari 5 + 3 adalah?',
            'question_type' => 'multiple_choice'
        ]);

        $q3->options()->createMany([
            ['option_text' => '7', 'is_correct' => false],
            ['option_text' => '8', 'is_correct' => true],
            ['option_text' => '9', 'is_correct' => false],
            ['option_text' => '6', 'is_correct' => false],
        ]);

        // Quiz 3: Isian
        $quiz3 = Quiz::create([
            'title' => 'Bahasa Inggris Lanjutan',
            'description' => 'Quiz untuk mengisi kata yang hilang.',
            'status' => 'active',
            'created_by' => 1
        ]);

        $quiz3->questions()->create([
            'question_text' => 'Lengkapi: I ___ a student.',
            'question_type' => 'fill_blank'
        ]);
    }
}
