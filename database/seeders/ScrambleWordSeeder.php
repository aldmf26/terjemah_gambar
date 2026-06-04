<?php

namespace Database\Seeders;

use App\Models\ScrambleWord;
use Illuminate\Database\Seeder;

class ScrambleWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $words = [
            [
                'original_word' => 'gambut',
                'scrambled_word' => 'tabmug',
                'scientific_description' => 'Tanah gambut adalah jenis tanah yang terbentuk dari akumulasi sisa-sisa tumbuhan yang setengah membusuk, memiliki kandungan bahan organik yang sangat tinggi dan mampu menyimpan cadangan karbon besar.',
                'illustration_image' => 'assets/images/wetland/gambut.jpg',
                'level_tier' => 1,
            ],
            [
                'original_word' => 'mangrove',
                'scrambled_word' => 'vorgeman',
                'scientific_description' => 'Mangrove adalah komunitas vegetasi pantai tropis dan subtropis yang didominasi oleh spesies pohon yang mampu tumbuh dan berkembang pada daerah pasang surut pantai berlumpur.',
                'illustration_image' => 'assets/images/wetland/mangrove.jpg',
                'level_tier' => 2,
            ],
            [
                'original_word' => 'rawa',
                'scrambled_word' => 'waar',
                'scientific_description' => 'Rawa adalah lahan genangan air secara ilmiah yang terjadi terus menerus atau musiman akibat drainase yang terhambat serta mempunyai ciri-ciri khusus secara fisika, kimiawi, dan biologis.',
                'illustration_image' => 'assets/images/wetland/rawa.jpg',
                'level_tier' => 3,
            ],
        ];

        foreach ($words as $word) {
            ScrambleWord::create($word);
        }
    }
}