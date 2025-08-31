<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $title = "Quiz";
        $search = $request->search;

        $quizzes = Quiz::when($search, function ($query, $search) {
            return $query->where('question', 'like', "%$search%");
        })->paginate(10);

        return view('admin.quiz.index', compact('quizzes', 'title', 'search'));
    }

    public function create()
    {
        $title = "Tambah Quiz";
        return view('admin.quiz.create', compact('title'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'question' => 'required|string',
        //     'type' => 'required|in:multiple_choice,true_false,fill_blank,matching',
        //     'options' => 'sometimes|array',
        //     'options.*.text' => 'sometimes|required_with:options|string',
        //     'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        // ]);

        DB::beginTransaction();
        try {
            // Buat quiz (title diambil dari question jika tidak ada title di form)
            $quiz = Quiz::create([
                'title' => $request->title ?? Str::limit($request->question, 50),
                'description' => $request->description ?? null,
                'status' => 'active',
                'created_by' => auth()->id(),
            ]);

            // // simpan file image (opsional) untuk question
            // $imageName = null;
            // if ($request->hasFile('image')) {
            //     $imageName = time() . '.' . $request->image->extension();
            //     $request->image->move(public_path('uploads'), $imageName);
            // }

            // // buat question yang terkait dengan quiz
            // $question = $quiz->questions()->create([
            //     'question_text' => $request->question,
            //     'question_type' => $request->type,
            //     'image' => $imageName,
            // ]);

            // // jika multiple_choice, simpan options
            // if ($request->type === 'multiple_choice' && $request->has('options')) {
            //     foreach ($request->options as $opt) {
            //         $question->options()->create([
            //             'option_text' => $opt['text'],
            //             'is_correct' => isset($opt['is_correct']) ? 1 : 0,
            //         ]);
            //     }
            // }

            DB::commit();
            return redirect()->route('quizzes.index')->with('sukses', 'Quiz dan soal berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['msg' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $quiz = Quiz::with('options')->findOrFail($id);
        $title = "Edit Quiz";

        return view('admin.quiz.edit', compact('quiz', 'title'));
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $request->validate([
            'question' => 'required|string|max:255',
            'type' => 'required|in:multiple_choice,true_false,fill_blank,matching',
        ]);

        $quiz->update([
            'question' => $request->question,
            'type' => $request->type,
            'image' => $request->image ?? $quiz->image,
        ]);

        $quiz->options()->delete();

        foreach ($request->options as $option) {
            Option::create([
                'quiz_id' => $quiz->id,
                'option_text' => $option['text'],
                'is_correct' => isset($option['is_correct']) ? 1 : 0,
            ]);
        }

        return redirect()->route('quizzes.index')->with('sukses', 'Quiz berhasil diperbarui');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->route('quizzes.index')->with('sukses', 'Quiz berhasil dihapus');
    }
}
