<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Carbon\Carbon;
use Livewire\Component;

class Quizplay extends Component
{
    public $quiz;
    public $type;
    public $questions;
    public $answers = [];
    public $attemptId;
    public $currentIndex = 0;

    public function mount()
    {
        // $this->quiz = Quiz::findOrFail($quizId);
        // $this->type = $type;

        // $attempt = QuizAttempt::create([
        //     'quiz_id' => $this->quiz->id,
        //     'user_id' => Auth::id(),
        //     'start_time' => Carbon::now(),
        // ]);

        // $this->attemptId = $attempt->id;

        $this->questions = $this->quiz->questions()
            ->where('question_type', $this->type)
            ->with('options')
            ->get()
            ->values(); // reset index
    }

    public function next()
    {
        if ($this->currentIndex < $this->questions->count() - 1) {
            $this->currentIndex++;
        }
    }

    public function prev()
    {
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
        }
    }

    public function submit()
    {
        $score = 0;
        foreach ($this->answers as $questionId => $answerValue) {
            $question = $this->questions->where('id', $questionId)->first();
            if (!$question) continue;

            if ($question->question_type == 'multiple_choice' || $question->question_type == 'true_false') {
                $isCorrect = $question->options->where('id', $answerValue)->where('is_correct', 1)->count() > 0;
                if ($isCorrect) $score++;
                Answer::updateOrCreate(
                    ['quiz_attempt_id' => $this->attemptId, 'question_id' => $question->id],
                    ['option_id' => $answerValue, 'is_correct' => $isCorrect]
                );
            } elseif ($question->question_type == 'fill_blank') {
                $correct = strtolower(trim($question->options->first()->option_text));
                $userAnswer = strtolower(trim($answerValue));
                $isCorrect = $userAnswer === $correct;
                if ($isCorrect) $score++;
                Answer::updateOrCreate(
                    ['quiz_attempt_id' => $this->attemptId, 'question_id' => $question->id],
                    ['answer_text' => $userAnswer, 'is_correct' => $isCorrect]
                );
            }
        }

        QuizAttempt::where('id', $this->attemptId)->update([
            'end_time' => Carbon::now(),
            'score' => $score,
        ]);

        return redirect()->route('quiz.result', $this->attemptId);
    }

    public function render()
    {
        $question = $this->questions[$this->currentIndex] ?? null;
        return view('livewire.quizplay', [
            'question' => $question,
            'index' => $this->currentIndex + 1,
            'total' => $this->questions->count()
        ]);
    }
}
