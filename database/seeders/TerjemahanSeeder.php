<?php

namespace Database\Seeders;

use App\Models\Terjemahan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TerjemahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['ind' => 'Kucing', 'en' => 'Cat', 'image' => 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131'],
            ['ind' => 'Anjing', 'en' => 'Dog', 'image' => 'https://images.unsplash.com/photo-1560807707-8cc77767d783'],
            ['ind' => 'Burung', 'en' => 'Bird', 'image' => 'https://images.unsplash.com/photo-1508873535684-277a3cbcc4e4'],
            ['ind' => 'Ikan', 'en' => 'Fish', 'image' => 'https://images.unsplash.com/photo-1550684848-0a098e81e3b9'],
            ['ind' => 'Kelinci', 'en' => 'Rabbit', 'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b'],
            ['ind' => 'Gajah', 'en' => 'Elephant', 'image' => 'https://images.unsplash.com/photo-1592194996308-7fefb7c55b37'],
            ['ind' => 'Singa', 'en' => 'Lion', 'image' => 'https://images.unsplash.com/photo-1546182990-dffeafbe841d'],
            ['ind' => 'Harimau', 'en' => 'Tiger', 'image' => 'https://images.unsplash.com/photo-1592194996308-7fefb7c55b37'],
            ['ind' => 'Serigala', 'en' => 'Wolf', 'image' => 'https://images.unsplash.com/photo-1566438485231-1c8eee1d1f69'],
            ['ind' => 'Kuda', 'en' => 'Horse', 'image' => 'https://images.unsplash.com/photo-1548797253-8c94739e7c36'],
            ['ind' => 'Sapi', 'en' => 'Cow', 'image' => 'https://images.unsplash.com/photo-1574168986488-adecfb8c511d'],
            ['ind' => 'Kambing', 'en' => 'Goat', 'image' => 'https://images.unsplash.com/photo-1516975088842-6ddcb9e9c960'],
            ['ind' => 'Babi', 'en' => 'Pig', 'image' => 'https://images.unsplash.com/photo-1559791587-d3eae5290ea9'],
            ['ind' => 'Ayam', 'en' => 'Chicken', 'image' => 'https://images.unsplash.com/photo-1616627970345-53b0f34d4a9f'],
            ['ind' => 'Bebek', 'en' => 'Duck', 'image' => 'https://images.unsplash.com/photo-1616627970345-53b0f34d4a9f'],
            ['ind' => 'Merpati', 'en' => 'Pigeon', 'image' => 'https://images.unsplash.com/photo-1597350694791-27e2e2f4f48a'],
            ['ind' => 'Rusa', 'en' => 'Deer', 'image' => 'https://images.unsplash.com/photo-1546182990-dffeafbe841d'],
            ['ind' => 'Kucing Hutan', 'en' => 'Wild Cat', 'image' => 'https://images.unsplash.com/photo-1581868164311-210f1b13f116'],
            ['ind' => 'Panda', 'en' => 'Panda', 'image' => 'https://images.unsplash.com/photo-1546182990-dffeafbe841d'],
            ['ind' => 'Koala', 'en' => 'Koala', 'image' => 'https://images.unsplash.com/photo-1546182990-dffeafbe841d'],
        ];
        foreach($data as $i => $d){
            Terjemahan::create([
                'ind' => $d['ind'],
                'en' => $d['en'],
                'image' => 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131',
            ]);
        }

    }
}
