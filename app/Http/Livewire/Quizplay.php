<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Quizplay extends Component
{
    public $quiz;
    public $type;
    public $attemptId;
    public $questions;
    public $currentIndex = 0;
    public $currentQuestion;
    public $answers = [];
    public $attempt;

    public $questionsPerPage = 2; // Untuk matching, tampilkan 4 soal sekaligus
    public $currentQuestions = [];

    public function mount($quizId, $type)
    {
        $this->quiz = Quiz::findOrFail($quizId);
        // ambil pertanyaan sesuai type
        $this->questions = Question::where('quiz_id', $quizId)
            ->where('question_type', $type)
            ->with('options')
            ->when($type === 'matching', function ($query) {
                return $query->take($this->questionsPerPage);
            })
            ->get();


        $this->currentQuestion = $this->questions[$this->currentIndex] ?? null;

        // buat attempt baru, tapi hanya jika user belum pernah mengerjakan quiz ini
        $existingAttempt = QuizAttempt::where('quiz_id', $this->quiz->id)
            ->where('user_id', Auth::id())
            ->first();
        if (!$existingAttempt) {
            $this->attempt = QuizAttempt::create([
                'quiz_id' => $this->quiz->id,
                'user_id' => Auth::id(),
                'started_at' => now(),
            ]);
            $this->attemptId = $this->attempt->id;
        } else {
            $this->attemptId = $existingAttempt->id;
            $this->attempt = $existingAttempt;
        }
    }



    public function next()
    {
        if ($this->currentIndex < count($this->questions) - 1) {
            if ($this->type === 'matching') {
                // jika matching, maka tampilkan 4 lanjutan soalnya lagi
                $this->currentIndex += $this->questionsPerPage - 1;
            } else {
                $this->currentIndex++;
            }
            $this->currentQuestion = $this->questions[$this->currentIndex];
        }
    }

    public function back()
    {
        if ($this->currentIndex > 0) {
            if ($this->type === 'matching') {
                // jika matching, maka tampilkan 4 soal sebelumnya lagi
                $this->currentIndex -= $this->questionsPerPage - 1;
            } else {
                $this->currentIndex--;
            }
            $this->currentQuestion = $this->questions[$this->currentIndex];
        }
    }

    public function saveAnswer($questionId, $answer)
    {
        $this->answers[$questionId] = $answer;
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
                    ['attempt_id' => $this->attemptId, 'question_id' => $question->id],
                    ['user_answer' => $answerValue, 'is_correct' => $isCorrect]
                );
            } elseif ($question->question_type == 'fill_blank') {
                $correct = strtolower(trim($question->options->first()->option_text));
                $userAnswer = strtolower(trim($answerValue));
                $isCorrect = $userAnswer === $correct;
                if ($isCorrect) $score++;
                Answer::updateOrCreate(
                    ['attempt_id' => $this->attemptId, 'question_id' => $question->id],
                    ['user_answer' => $userAnswer, 'is_correct' => $isCorrect]
                );
            }
        }

        QuizAttempt::where('id', $this->attemptId)->update([
            'completed_at' => Carbon::now(),
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
