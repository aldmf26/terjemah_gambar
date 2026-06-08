<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrambleWord extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_word',
        'scrambled_word',
        'scientific_description',
        'illustration_image',
        'level_tier',
        'question'
    ];
}