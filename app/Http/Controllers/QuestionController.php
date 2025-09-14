<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index(Quiz $quiz, Request $request)
    {
        $search = $request->search;
        $tipe = $request->tipe ?? 'multiple_choice';


        $questions = $quiz->questions()->with('options')->when($search, function ($query, $search) {
            return $query->where('question_text', 'like', "%$search%");
        })->where('question_type', $tipe)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.questions.index', compact(
            'quiz', 'questions', 'search', 'tipe'
        ));
    }

    public function create(Quiz $quiz)
    {
        return view('admin.questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        DB::beginTransaction();
        try {
            // $request->validate([
            //     'question_text' => 'required|string',
            //     'question_type' => 'required|in:multiple_choice,true_false,fill_blank',
            //     'options' => 'required_if:question_type,multiple_choice|array|min:2',
            //     'options.*.text' => 'required_if:question_type,multiple_choice|string',
            // ]);

            $questionText = $request->question_text;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/questions'), $imageName);
                $questionText = $imageName;
            }

            $question = $quiz->questions()->create([
                'question_text' => $questionText,
                'question_type' => $request->question_type,
            ]);

            if ($request->question_type === 'multiple_choice') {
                $hasCorrect = false;
                foreach ($request->options as $option) {
                    if (isset($option['is_correct'])) {
                        $hasCorrect = true;
                        break;
                    }
                }

                if (!$hasCorrect) {
                    return back()->withErrors(['options' => 'Pilih minimal satu jawaban benar'])->withInput();
                }
                foreach ($request->options as $option) {
                    $question->options()->create([
                        'option_text' => $option['text'],
                        'is_correct' => isset($option['is_correct']) ? 1 : 0,
                    ]);
                }
            } elseif ($request->question_type === 'true_false') {
                $correct = $request->correct_option; // 'Benar' atau 'Salah'
                $question->options()->create([
                    'option_text' => 'True',
                    'is_correct' => $correct === 'True' ? 1 : 0,
                ]);
                $question->options()->create([
                    'option_text' => 'False',
                    'is_correct' => $correct === 'False' ? 1 : 0,
                ]);
            } elseif ($request->question_type === 'fill_blank') {
                $question->options()->create([
                    'option_text' => $request->correct_answer_fill,
                    'is_correct' => 1,

                ]);
            } elseif ($request->question_type === 'matching') {
                $question->update([
                    'option_text' => $request->correct_answer,
                    'is_correct' => 1,
                ]);
                foreach ($request->correct_answer_pairs as $pair) {
                    list($key, $value) = $pair;
                    $question->options()->create([
                        'option_text' => $value,
                        'pair_key' => $key,
                    ]);
                }
            }


            DB::commit();
            return redirect()->route('quiz.questions.index', [$quiz->id, 'tipe' => $request->question_type])->with('sukses', 'Pertanyaan berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Quiz $quiz, Question $question)
    {
        return view('admin.questions.edit', compact('quiz', 'question'));
    }

    public function update(Request $request, Quiz $quiz, Question $question)
    {
        DB::beginTransaction();
        try {

            $questionText = $question->question_text; // default pakai data lama

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/questions'), $imageName);
                $questionText = $imageName;
            } elseif ($request->filled('question_text')) {
                $questionText = $request->question_text;
            }

            $question->update([
                'question_text' => $questionText,
                'question_type' => $request->question_type,
            ]);

            // Hapus opsi lama (jika ada)
            $question->options()->delete();

            if ($request->question_type === 'multiple_choice') {
                $hasCorrect = false;
                foreach ($request->options as $option) {
                    if (isset($option['is_correct'])) {
                        $hasCorrect = true;
                        break;
                    }
                }

                if (!$hasCorrect) {
                    return back()->withErrors(['options' => 'Pilih minimal satu jawaban benar'])->withInput();
                }

                foreach ($request->options as $option) {
                    $question->options()->create([
                        'option_text' => $option['text'],
                        'is_correct' => isset($option['is_correct']) ? 1 : 0,
                    ]);
                }
            } elseif ($request->question_type === 'true_false') {
                $correct = $request->correct_option; // 'Benar' atau 'Salah'
                $question->options()->create([
                    'option_text' => 'True',
                    'is_correct' => $correct === 'True' ? 1 : 0,
                ]);
                $question->options()->create([
                    'option_text' => 'False',
                    'is_correct' => $correct === 'False' ? 1 : 0,
                ]);
            } elseif ($request->question_type === 'fill_blank' || $request->question_type === 'matching') {
                $question->update([
                    'correct_answer' => $request->correct_answer,
                ]);
                $question->options()->create([
                    'option_text' => $request->correct_answer,
                    'is_correct' => 1,
                ]);
            }

            DB::commit();
            return redirect()->route('quiz.questions.index', $quiz->id)->with('sukses', 'Pertanyaan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function destroy(Quiz $quiz, Question $question)
    {
        $question->delete();

        return back()->with('sukses', 'Pertanyaan berhasil dihapus!');
    }
}
