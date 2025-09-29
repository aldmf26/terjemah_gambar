<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Carbon\Carbon;
use Illuminate\Support\Arr;
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

    // untuk matching
    public $matches = [];
    public $completed = false;
    public $optionsMatching;

    public $currentQuestions = [];

    public $questionsPerPage = 4;

    public function mount($quizId, $type)
    {
        $this->quiz = Quiz::findOrFail($quizId);
        // ambil pertanyaan sesuai type
        $this->questions = Question::where('quiz_id', $quizId)
            ->where('question_type', $type)
            ->with('options')
            ->get();

        $options = $this->questions
            ->pluck('options')
            ->flatten()
            ->map(fn($o) => ['id' => $o->id, 'text' => $o->option_text])
            ->toArray();

        shuffle($options); // langsung acak list

        $this->optionsMatching = $options;

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

    public function selectMatch($leftId, $rightId)
    {
        $this->matches[$leftId] = $rightId;
        if (count($this->matches) === count($this->questions)) {
            $this->completed = true;
        }
    }



    public function next()
    {
        if ($this->currentIndex < count($this->questions) - 1) {
            if ($this->type === 'matching') {
                // jika matching, maka tampilkan 4 lanjutan soalnya lagi
                // $this->currentIndex += $this->questionsPerPage - 1;
            } else {
                $this->currentIndex++;
            }
            $this->currentQuestion = $this->questions[$this->currentIndex];
        }
    }

    public function prev()
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
        if ($this->type === 'matching') {
            foreach ($this->matches as $questionId => $selectedOptionId) {
                $question = $this->questions->where('id', $questionId)->first();
                if (!$question) continue;

                $attempt = QuizAttempt::find($this->attemptId);

                // Cari jawaban lama user untuk matching
                $oldAnswer = Answer::where('attempt_id', $this->attemptId)
                    ->where('question_id', $question->id)
                    ->first();

                // Untuk matching, cek apakah option yang dipilih adalah option yang benar untuk question ini
                $isCorrect = $question->options->where('id', $selectedOptionId)->where('is_correct', 1)->count() > 0;

                // Update skor berdasarkan jawaban lama
                if ($oldAnswer) {
                    if ($oldAnswer->is_correct && !$isCorrect) {
                        // dulunya benar, sekarang salah → kurangi skor
                        $attempt->score -= 10;
                    } elseif (!$oldAnswer->is_correct && $isCorrect) {
                        // dulunya salah, sekarang benar → tambah skor
                        $attempt->score += 10;
                    }
                } else {
                    // belum pernah jawab → kalau benar, tambah skor
                    if ($isCorrect) {
                        $attempt->score += 10;
                    }
                }

                // Simpan jawaban matching - gunakan option_id sebagai user_answer
                Answer::updateOrCreate(
                    ['attempt_id' => $this->attemptId, 'question_id' => $question->id],
                    ['user_answer' => $selectedOptionId, 'is_correct' => $isCorrect]
                );

                $attempt->completed_at = Carbon::now();
                $attempt->save();
            }
        } else {
            foreach ($this->answers as $questionId => $answerValue) {
                $question = $this->questions->where('id', $questionId)->first();
                if (!$question) continue;

                $attempt = QuizAttempt::find($this->attemptId);

                // Cari jawaban lama user
                $oldAnswer = Answer::where('attempt_id', $this->attemptId)
                    ->where('question_id', $question->id)
                    ->first();

                $isCorrect = false;

                if ($question->question_type == 'multiple_choice' || $question->question_type == 'true_false') {
                    $isCorrect = $question->options->where('id', $answerValue)->where('is_correct', 1)->count() > 0;
                } elseif ($question->question_type == 'fill_blank') {
                    $correct = strtolower(trim($question->options->first()->option_text));
                    $userAnswer = strtolower(trim($answerValue));
                    $isCorrect = $userAnswer === $correct;
                }

                // Update skor berdasarkan jawaban lama
                if ($oldAnswer) {
                    if ($oldAnswer->is_correct && !$isCorrect) {
                        // dulunya benar, sekarang salah → kurangi skor
                        $attempt->score -= 10;
                    } elseif (!$oldAnswer->is_correct && $isCorrect) {
                        // dulunya salah, sekarang benar → tambah skor
                        $attempt->score += 10;
                    }
                } else {
                    // belum pernah jawab → kalau benar, tambah skor
                    if ($isCorrect) {
                        $attempt->score += 10;
                    }
                }

                // Simpan jawaban baru
                Answer::updateOrCreate(
                    ['attempt_id' => $this->attemptId, 'question_id' => $question->id],
                    ['user_answer' => $answerValue, 'is_correct' => $isCorrect]
                );

                $attempt->completed_at = Carbon::now();
                $attempt->save();
            }
        }


        return redirect()->route('participant.quiz.result', $this->attemptId);
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
