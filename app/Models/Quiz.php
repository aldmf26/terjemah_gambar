<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'created_by'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function options()
    {
        return $this->hasManyThrough(Option::class, Question::class);
    }
}
