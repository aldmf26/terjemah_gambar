<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrambleSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'background_music',
        'background_image',
        'timer_duration',
        'min_score_to_unlock_intermediate',
        'min_score_to_unlock_advanced',
    ];
}