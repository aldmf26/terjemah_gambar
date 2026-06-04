<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BookStock;
use App\Models\Terjemahan;
use App\Models\User;
use App\Models\Quiz;
use App\Models\ScrambleWord;
use App\Models\QuizAttempt;
use App\Models\ScrambleAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{

    public function index()
    {
        if(auth()->user()->hasRole('user')) {
            return redirect()->route('participant.user.dashboard');
        }

        // Stats
        $countTerjemah = Terjemahan::count();
        $countUsers = User::role('user')->count();
        $countAdmin = User::role(['admin', 'superadmin'])->count();
        $countQuizzes = Quiz::count();
        $countScrambleWords = ScrambleWord::count();

        // Recent Quiz Attempts
        $recentQuizAttempts = QuizAttempt::with('user', 'quiz')
            ->whereNotNull('completed_at')
            ->latest('completed_at')
            ->take(5)
            ->get();

        // Recent Scramble Attempts
        $recentScrambleAttempts = ScrambleAttempt::with('user')
            ->latest('created_at')
            ->take(5)
            ->get();

        // Load motivasi text
        $motivasiText = '';
        if (Storage::exists('motivasi.json')) {
            $motivasiArray = json_decode(Storage::get('motivasi.json'), true);
            if (is_array($motivasiArray)) {
                $motivasiText = implode("\n", $motivasiArray);
            }
        }

        $data = [
            'title' => 'Dashboard',
            'countTerjemah' => $countTerjemah,
            'countUsers' => $countUsers,
            'countAdmin' => $countAdmin,
            'countQuizzes' => $countQuizzes,
            'countScrambleWords' => $countScrambleWords,
            'recentQuizAttempts' => $recentQuizAttempts,
            'recentScrambleAttempts' => $recentScrambleAttempts,
            'motivasiText' => $motivasiText,
        ];
        return view('dashboard', $data);
    }

    public function motivasiIndex()
    {
        // Load existing motivasi strings from storage
        $motivasi = [];
        if (Storage::exists('motivasi.json')) {
            $motivasi = json_decode(Storage::get('motivasi.json'), true) ?? [];
        }
        return view('dashboard.motivasi', ['motivasi' => $motivasi]);
    }

    public function storeMotivasi(Request $request)
    {
        $request->validate([
            'motivasi' => 'required|string',
        ]);
        $new = $request->input('motivasi');
        $motivasi = [];
        if (Storage::exists('motivasi.json')) {
            $motivasi = json_decode(Storage::get('motivasi.json'), true) ?? [];
        }
        $motivasi[] = $new;
        Storage::put('motivasi.json', json_encode(array_values($motivasi), JSON_PRETTY_PRINT));
        return back()->with('sukses', 'Motivasi berhasil ditambahkan.');
    }

    public function deleteMotivasi($index)
    {
        $motivasi = [];
        if (Storage::exists('motivasi.json')) {
            $motivasi = json_decode(Storage::get('motivasi.json'), true) ?? [];
        }
        if (array_key_exists($index, $motivasi)) {
            unset($motivasi[$index]);
            // Re-index array to maintain sequential keys
            $motivasi = array_values($motivasi);
            Storage::put('motivasi.json', json_encode($motivasi, JSON_PRETTY_PRINT));
        }
        return back()->with('sukses', 'Motivasi berhasil dihapus.');
    }
}
