<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\ScrambleWord;
use App\Models\ScrambleSetting;
use App\Models\ScrambleAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WordScrambleController extends Controller
{
    /**
     * Mengambil data kata berdasarkan level untuk API / Livewire
     */
    public function getWordsByLevel($level)
    {
        return ScrambleWord::where('level_tier', $level)
            ->inRandomOrder()
            ->get();
    }

    /**
     * Menyimpan riwayat permainan user setelah selesai
     */
    public function storeAttempt(Request $request)
    {
        $validated = $request->validate([
            'score' => 'required|integer',
            'remaining_time' => 'required|integer',
            'status' => 'required|in:win,lose',
            'game_mode' => 'required|string',
        ]);

        $attempt = ScrambleAttempt::create([
            'user_id' => Auth::id(),
            'score' => $validated['score'],
            'remaining_time' => $validated['remaining_time'],
            'status' => $validated['status'],
            'game_mode' => $validated['game_mode'],
        ]);

        return response()->json([
            'success' => true,
            'data' => $attempt
        ], 201);
    }

    /**
     * Mengambil konfigurasi game terbaru
     */
    public function getSettings()
    {
        return ScrambleSetting::first() ?? response()->json(['message' => 'Settings not found'], 404);
    }

    /**
     * Admin: Tampilkan daftar kata scramble
     */
    public function index(Request $request)
    {
        $query = ScrambleWord::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('original_word', 'like', '%' . $request->search . '%')
                  ->orWhere('scientific_description', 'like', '%' . $request->search . '%');
        }
        $words = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.scramble.index', [
            'title' => 'Word Scramble',
            'words' => $words,
            'search' => $request->search ?? ''
        ]);
    }

    /**
     * Admin: Form tambah kata
     */
    public function create()
    {
        return view('admin.scramble.create', [
            'title' => 'Tambah Kata Scramble'
        ]);
    }

    /**
     * Admin: Simpan kata baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'original_word' => 'required|string|max:255',
            'scrambled_word' => 'required|string|max:255',
            'scientific_description' => 'required|string',
            'illustration_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'level_tier' => 'required|in:1,2,3',
        ]);

        $imageName = null;
        if ($request->hasFile('illustration_image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->file('illustration_image')->extension();
            $request->file('illustration_image')->move(public_path('uploads'), $imageName);
            $imageName = 'uploads/' . $imageName;
        }

        ScrambleWord::create([
            'original_word' => strtolower($request->original_word),
            'scrambled_word' => strtolower($request->scrambled_word),
            'scientific_description' => $request->scientific_description,
            'illustration_image' => $imageName,
            'level_tier' => $request->level_tier,
        ]);

        return redirect()->route('scramble-words.index')->with('sukses', 'Berhasil menambahkan kata baru.');
    }

    /**
     * Admin: Form edit kata
     */
    public function edit($id)
    {
        $word = ScrambleWord::findOrFail($id);
        return view('admin.scramble.edit', [
            'title' => 'Edit Kata Scramble',
            'word' => $word
        ]);
    }

    /**
     * Admin: Perbarui kata
     */
    public function update(Request $request, $id)
    {
        $word = ScrambleWord::findOrFail($id);

        $request->validate([
            'original_word' => 'required|string|max:255',
            'scrambled_word' => 'required|string|max:255',
            'scientific_description' => 'required|string',
            'illustration_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'level_tier' => 'required|in:1,2,3',
        ]);

        $imagePath = $word->illustration_image;
        if ($request->hasFile('illustration_image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->file('illustration_image')->extension();
            $request->file('illustration_image')->move(public_path('uploads'), $imageName);
            $imagePath = 'uploads/' . $imageName;
        }

        $word->update([
            'original_word' => strtolower($request->original_word),
            'scrambled_word' => strtolower($request->scrambled_word),
            'scientific_description' => $request->scientific_description,
            'illustration_image' => $imagePath,
            'level_tier' => $request->level_tier,
        ]);

        return redirect()->route('scramble-words.index')->with('sukses', 'Berhasil memperbarui kata.');
    }

    /**
     * Admin: Hapus kata
     */
    public function destroy($id)
    {
        $word = ScrambleWord::findOrFail($id);
        $word->delete();
        return redirect()->route('scramble-words.index')->with('sukses', 'Berhasil menghapus kata.');
    }

    /**
     * Admin: Form edit settings
     */
    public function editSettings()
    {
        $settings = ScrambleSetting::firstOrCreate([], [
            'timer_duration' => 60,
            'min_score_to_unlock_intermediate' => 100,
            'min_score_to_unlock_advanced' => 250,
        ]);

        return view('admin.scramble.settings', [
            'title' => 'Pengaturan Scramble',
            'settings' => $settings
        ]);
    }

    /**
     * Admin: Update settings
     */
    public function updateSettings(Request $request)
    {
        $settings = ScrambleSetting::first();
        if (!$settings) {
            $settings = new ScrambleSetting();
        }

        $request->validate([
            'background_music' => 'nullable|mimes:mp3,wav|max:10240',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'timer_duration' => 'required|integer|min:10',
            'min_score_to_unlock_intermediate' => 'required|integer|min:0',
            'min_score_to_unlock_advanced' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('background_music')) {
            $musicName = 'music_' . time() . '.' . $request->file('background_music')->extension();
            $request->file('background_music')->move(public_path('uploads'), $musicName);
            $settings->background_music = 'uploads/' . $musicName;
        }

        if ($request->hasFile('background_image')) {
            $imageName = 'bg_' . time() . '.' . $request->file('background_image')->extension();
            $request->file('background_image')->move(public_path('uploads'), $imageName);
            $settings->background_image = 'uploads/' . $imageName;
        }

        $settings->timer_duration = $request->timer_duration;
        $settings->min_score_to_unlock_intermediate = $request->min_score_to_unlock_intermediate;
        $settings->min_score_to_unlock_advanced = $request->min_score_to_unlock_advanced;
        $settings->save();

        return redirect()->back()->with('sukses', 'Pengaturan berhasil diperbarui.');
    }
}