<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Quiz;
use App\Models\QuizAttempt;
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
            return $query->where('title', 'like', "%$search%");
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

    // Dashboard: tampilkan list quiz
    public function dashboard()
    {
        $quizzes = Quiz::withCount('questions')->get();
        return view('participant.dashboard', compact('quizzes'));
    }

    // Halaman pilih tipe soal
    public function showTypes(Quiz $quiz)
    {
        // ambil distinct tipe pertanyaan
        $types = $quiz->questions()->select('question_type')->distinct()->pluck('question_type');

        // Ambil semua attempt user untuk quiz ini
        $attempts = QuizAttempt::where('quiz_id', $quiz->id)
            ->where('user_id', auth()->id())
            ->withCount('answers')
            ->get();

        // Simpan tipe yang sudah pernah dijawab
        $completedTypes = [];
        $attemptMap = []; // simpan attempt_id per tipe

        foreach ($attempts as $attempt) {
            $answeredTypes = $attempt->answers()
                ->with('question:id,question_type')
                ->get()
                ->pluck('question.question_type')
                ->unique();

            foreach ($answeredTypes as $t) {
                $completedTypes[] = $t;
                // Simpan attempt_id terakhir untuk tipe ini
                $attemptMap[$t] = $attempt->id;
            }
        }

        $completedTypes = array_unique($completedTypes);

        return view('participant.types', compact('quiz', 'types', 'completedTypes', 'attemptMap'));
    }

    // Mulai kerjakan quiz sesuai tipe
    public function start(Quiz $quiz, $type)
    {
        $attemptId = $quiz->id;
        $questions = $quiz->questions()->where('question_type', $type)->with('options')->get();
        $duration = $quiz->duration ?? 15; // menit
        return view('participant.start', compact('quiz', 'questions', 'type', 'duration', 'attemptId'));
    }


    public function result($attemptId)
    {
        $attempt = \App\Models\QuizAttempt::with(['quiz.questions.options', 'answers'])->find($attemptId);
        if (!$attempt) {
            abort(404, 'Attempt tidak ditemukan');
        }

        $types = ['multiple_choice', 'true_false', 'fill_blank', 'matching'];

        $summary = [];
        foreach ($types as $type) {
            $total = $attempt->quiz->questions()->where('question_type', $type)->count();
            $answered = $attempt->answers->whereIn(
                'question_id',
                $attempt->quiz->questions()->where('question_type', $type)->pluck('id')
            );

            $correct = $answered->where('is_correct', 1)->count();

            $summary[$type] = [
                'total' => $total,
                'answered' => $answered->count(),
                'correct' => $correct,
            ];
        }

        // total keseluruhan
        $totalQuestions = $attempt->quiz->questions()->count();
        $totalCorrect   = $attempt->answers->where('is_correct', 1)->count();

        return view('participant.result', compact('attempt', 'summary', 'totalQuestions', 'totalCorrect'));
    }

    public function result_detail($attemptId, $type)
    {
        $attempt = \App\Models\QuizAttempt::with(['quiz.questions.options', 'answers'])
            ->findOrFail($attemptId);

        $questions = $attempt->quiz->questions()
            ->where('question_type', $type)
            ->with('options')
            ->get();

        $answers = $attempt->answers()
            ->whereIn('question_id', $questions->pluck('id'))
            ->get();


        $totalQuestions = $questions->count();
        $totalCorrect = $answers->where('is_correct', true)->count();
        $scorePercentage = $totalQuestions > 0 ? round(($totalCorrect / $totalQuestions) * 100) : 0;


        return view('participant.result_detail', compact(
            'attempt',
            'questions',
            'answers',
            'type',
            'totalQuestions',
            'totalCorrect',
            'scorePercentage'
        ));
    }

    public function dashboard_user()
    {
        $userId = auth()->id();

        // Statistik pribadi
        $stats = DB::table('quiz_attempts')
            ->selectRaw('
            COUNT(DISTINCT quiz_id) as selesai,
            SUM(score) as total_poin
        ')
            ->where('user_id', $userId)
            ->first();
        $totalQuiz   = Quiz::count();
        $quizSelesai = $stats->selesai ?? 0;
        $totalPoin   = $stats->total_poin ?? 0;

        // Leaderboard Top 10
        $ranking = DB::table('quiz_attempts')
            ->join('users', 'quiz_attempts.user_id', '=', 'users.id')
            ->select(
                'users.name',
                DB::raw('SUM(score) as total_poin')
            )
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_poin')
            ->limit(10)
            ->get();

        return view('participant.dashboard_user', compact(
            'totalQuiz',
            'quizSelesai',
            'totalPoin',
            'ranking'
        ));
    }


    public function riwayat()
    {
        $quizzes = Quiz::withCount('questions')->get();
        return view('participant.riwayat', compact('quizzes'));
    }
}
