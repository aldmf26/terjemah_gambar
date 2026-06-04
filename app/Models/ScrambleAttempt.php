<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScrambleAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'score',
        'remaining_time',
        'status',
        'game_mode',
    ];

    /**
     * Relasi balik ke model User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}