<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['attempt_id', 'question_id', 'user_answer', 'is_correct'];

    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class, 'attempt_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

   public function option()
{
    return $this->belongsTo(Option::class, 'user_answer'); 
    // karena user_answer menyimpan option_id
}
}
