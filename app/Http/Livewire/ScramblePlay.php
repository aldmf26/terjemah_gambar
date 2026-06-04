<?php

namespace App\Http\Livewire;

use App\Models\ScrambleWord;
use App\Models\ScrambleSetting;
use App\Models\ScrambleAttempt;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ScramblePlay extends Component
{
    // Mode Selection
    public $gameMode = null; // 'solo', 'vs_computer', 'vs_user'
    public $modeSelected = false;
    public $showNameInput = false;

    // Level Selection
    public $levelSelected = false;
    public $currentLevel = 1;
    public $totalScore = 0;
    public $isLevel2Unlocked = false;
    public $isLevel3Unlocked = false;

    // Game state
    public $words = [];
    public $currentIndex = 0;
    public $currentWord = null;
    public $userAnswer = '';
    public $scrambledLetters = [];

    // Timer
    public $timerDuration = 60;
    public $timeLeft = 60;

    // Status
    public $isPlaying = false;
    public $showPopup = false;
    public $popupTitle = '';
    public $isCorrect = false;
    public $scoreEarned = 0;
    public $gameOver = false;

    // VS Mode Properties
    public $currentTurn = 'player1'; // 'player1' or 'player2'
    public $player1Name = 'Pemain 1';
    public $player2Name = 'Pemain 2';
    public $player1Score = 0;
    public $player2Score = 0;
    public $computerThinking = false;
    public $turnMessage = '';
    public $wrongAttemptOnWord = false;
    public $winner = ''; // 'player1', 'player2', 'draw', ''

    // Settings
    public $bgMusic = null;
    public $bgImage = null;

    protected $listeners = ['timerExpired' => 'handleTimeOut'];

    public function mount()
    {
        $this->loadPlayerStatsAndSettings();
    }

    public function loadPlayerStatsAndSettings()
    {
        $settings = ScrambleSetting::firstOrCreate([], [
            'timer_duration' => 60,
            'min_score_to_unlock_intermediate' => 100,
            'min_score_to_unlock_advanced' => 250,
        ]);

        $this->timerDuration = $settings->timer_duration;
        $this->timeLeft = $settings->timer_duration;
        $this->bgMusic = $settings->background_music;
        $this->bgImage = $settings->background_image;

        // Calculate total score from previous win attempts
        $this->totalScore = ScrambleAttempt::where('user_id', Auth::id())
            ->where('status', 'win')
            ->sum('score');

        $this->isLevel2Unlocked = $this->totalScore >= $settings->min_score_to_unlock_intermediate;
        $this->isLevel3Unlocked = $this->totalScore >= $settings->min_score_to_unlock_advanced;
    }

    // ──────────────────────────────────────────────
    // MODE SELECTION
    // ──────────────────────────────────────────────

    public function selectMode($mode)
    {
        $this->gameMode = $mode;

        if ($mode === 'vs_user') {
            // Show name input form before proceeding
            $this->player1Name = 'Pemain 1';
            $this->player2Name = 'Pemain 2';
            $this->showNameInput = true;
        } elseif ($mode === 'vs_computer') {
            $this->player1Name = Auth::user()->name ?? 'Kamu';
            $this->player2Name = '🤖 Komputer';
            $this->modeSelected = true;
        } else {
            // Solo
            $this->player1Name = Auth::user()->name ?? 'Pemain';
            $this->modeSelected = true;
        }
    }

    public function confirmNames()
    {
        $this->player1Name = trim($this->player1Name) ?: 'Pemain 1';
        $this->player2Name = trim($this->player2Name) ?: 'Pemain 2';
        $this->modeSelected = true;
        $this->showNameInput = false;
    }

    // ──────────────────────────────────────────────
    // LEVEL SELECTION & GAME START
    // ──────────────────────────────────────────────

    public function selectLevel($level)
    {
        if ($level == 2 && !$this->isLevel2Unlocked) {
            session()->flash('error', 'Level 2 masih terkunci! Kumpulkan skor lebih banyak.');
            return;
        }

        if ($level == 3 && !$this->isLevel3Unlocked) {
            session()->flash('error', 'Level 3 masih terkunci! Kumpulkan skor lebih banyak.');
            return;
        }

        $this->currentLevel = $level;
        $this->levelSelected = true;
        $this->startGame();
    }

    public function startGame()
    {
        $this->words = ScrambleWord::where('level_tier', $this->currentLevel)
            ->inRandomOrder()
            ->get()
            ->toArray();

        if (empty($this->words)) {
            session()->flash('error', 'Belum ada kata terdaftar untuk level ini.');
            $this->levelSelected = false;
            return;
        }

        $this->currentIndex = 0;
        $this->isPlaying = true;
        $this->gameOver = false;
        $this->showPopup = false;
        $this->scoreEarned = 0;
        $this->player1Score = 0;
        $this->player2Score = 0;
        $this->currentTurn = 'player1';
        $this->computerThinking = false;
        $this->turnMessage = '';
        $this->wrongAttemptOnWord = false;
        $this->winner = '';

        $this->loadWord();
    }

    // ──────────────────────────────────────────────
    // WORD LOADING & SCRAMBLING
    // ──────────────────────────────────────────────

    public function loadWord()
    {
        if ($this->currentIndex >= count($this->words)) {
            $this->endGame(true);
            return;
        }

        $this->currentWord = $this->words[$this->currentIndex];
        $this->userAnswer = '';
        $this->timeLeft = $this->timerDuration;
        $this->showPopup = false;
        $this->computerThinking = false;
        $this->wrongAttemptOnWord = false;

        // Scramble logic
        $original = strtolower(trim($this->currentWord['original_word']));
        $scrambled = strtolower(trim($this->currentWord['scrambled_word'] ?? ''));

        if (empty($scrambled) || $scrambled === $original) {
            // Dynamic shuffle characters if DB scrambled word is empty or identical
            $letters = str_split($original);
            do {
                shuffle($letters);
            } while (implode('', $letters) === $original && count($letters) > 1);
            $this->scrambledLetters = $letters;
        } else {
            $this->scrambledLetters = str_split($scrambled);
        }

        $this->dispatchBrowserEvent('reset-timer', ['duration' => $this->timerDuration]);
    }

    // ──────────────────────────────────────────────
    // ANSWER SUBMISSION (CORE GAME LOGIC)
    // ──────────────────────────────────────────────

    public function submitAnswer()
    {
        if (!$this->isPlaying || $this->showPopup || $this->computerThinking) return;

        $this->turnMessage = ''; // Clear previous message

        $ans = strtolower(trim($this->userAnswer));
        $correctWord = strtolower(trim($this->currentWord['original_word']));

        if ($ans === $correctWord) {
            // ✅ CORRECT ANSWER
            $this->isCorrect = true;
            $points = 20 + max(0, intval($this->timeLeft / 5));

            if ($this->gameMode === 'solo' || $this->gameMode === null) {
                $this->scoreEarned += $points;
                $this->popupTitle = 'Hebat! Jawaban Anda Benar';
            } else {
                // VS modes - assign points to the active player
                if ($this->currentTurn === 'player1') {
                    $this->player1Score += $points;
                } else {
                    $this->player2Score += $points;
                }
                $currentPlayerName = $this->currentTurn === 'player1' ? $this->player1Name : $this->player2Name;
                $this->popupTitle = "✅ {$currentPlayerName} Menjawab Benar! (+{$points} poin)";
            }

            $this->showPopup = true;
        } else {
            // ❌ WRONG ANSWER — handle per mode
            if ($this->gameMode === 'vs_computer') {
                $this->handleWrongVsComputer();
            } elseif ($this->gameMode === 'vs_user') {
                $this->handleWrongVsUser();
            } else {
                // Solo mode - just show error
                session()->flash('game_error', 'Jawaban salah! Coba susun lagi.');
            }
        }
    }

    // ──────────────────────────────────────────────
    // VS KOMPUTER LOGIC
    // ──────────────────────────────────────────────

    private function handleWrongVsComputer()
    {
        if ($this->currentTurn === 'player1') {
            // Player salah → giliran komputer
            $this->turnMessage = '❌ Jawaban salah! Giliran berpindah ke Komputer...';
            $this->currentTurn = 'player2';
            $this->userAnswer = '';
            $this->computerThinking = true;

            // Trigger computer answer after 2-second delay via JS
            $this->dispatchBrowserEvent('computer-thinking', ['delay' => 2000]);
        }
    }

    /**
     * Called from JavaScript after the 2-second computer thinking delay.
     */
    public function processComputerAnswer()
    {
        if (!$this->isPlaying || !$this->computerThinking) return;

        $this->computerThinking = false;

        // Computer accuracy: 40-70% chance of correct answer
        $accuracy = rand(40, 70);
        $isComputerCorrect = (rand(1, 100) <= $accuracy);

        if ($isComputerCorrect) {
            // Computer got it right
            $points = 20 + max(0, intval($this->timeLeft / 5));
            $this->player2Score += $points;

            $this->isCorrect = true;
            $this->popupTitle = "🤖 Komputer Menjawab Benar! (+{$points} poin)";
            $this->showPopup = true;
        } else {
            // Computer also wrong — both failed, skip word
            $this->turnMessage = '🤖 Komputer juga salah! Kata dilewati, giliranmu lagi.';
            $this->currentTurn = 'player1';
            $this->userAnswer = '';
            $this->currentIndex++;

            // Small delay then load next word
            $this->dispatchBrowserEvent('both-failed-next', ['delay' => 1500]);
        }
    }

    // ──────────────────────────────────────────────
    // VS USER (BERGANTIAN) LOGIC
    // ──────────────────────────────────────────────

    private function handleWrongVsUser()
    {
        $currentPlayerName = $this->currentTurn === 'player1' ? $this->player1Name : $this->player2Name;

        if (!$this->wrongAttemptOnWord) {
            // First wrong attempt — switch turns, same word
            $this->wrongAttemptOnWord = true;
            $this->currentTurn = $this->currentTurn === 'player1' ? 'player2' : 'player1';
            $nextPlayerName = $this->currentTurn === 'player1' ? $this->player1Name : $this->player2Name;
            $this->turnMessage = "❌ {$currentPlayerName} salah! Giliran {$nextPlayerName} sekarang.";
            $this->userAnswer = '';

            // Reset timer for the next player's turn
            $this->timeLeft = $this->timerDuration;
            $this->dispatchBrowserEvent('reset-timer', ['duration' => $this->timerDuration]);
        } else {
            // Second wrong attempt — both failed, skip to next word
            $this->turnMessage = '❌ Kedua pemain gagal! Lanjut kata berikutnya...';
            $this->userAnswer = '';
            $this->currentIndex++;

            $this->dispatchBrowserEvent('both-failed-next', ['delay' => 1500]);
        }
    }

    /**
     * Called from JavaScript after the "both failed" delay.
     */
    public function loadNextAfterBothFailed()
    {
        $this->turnMessage = '';
        $this->loadWord();
    }

    // ──────────────────────────────────────────────
    // NAVIGATION & GAME FLOW
    // ──────────────────────────────────────────────

    public function nextWord()
    {
        $this->showPopup = false;
        $this->turnMessage = '';
        $this->currentIndex++;

        // In vs modes, alternate starting player for fairness
        if ($this->gameMode === 'vs_user') {
            $this->currentTurn = $this->currentTurn === 'player1' ? 'player2' : 'player1';
        } elseif ($this->gameMode === 'vs_computer') {
            $this->currentTurn = 'player1'; // Player always starts each word
        }

        $this->loadWord();
    }

    public function handleTimeOut()
    {
        if (!$this->isPlaying || $this->showPopup || $this->computerThinking) return;

        if ($this->gameMode === 'vs_computer') {
            if ($this->currentTurn === 'player1') {
                // Player timed out — give computer a chance
                $this->handleWrongVsComputer();
            }
        } elseif ($this->gameMode === 'vs_user') {
            $currentPlayerName = $this->currentTurn === 'player1' ? $this->player1Name : $this->player2Name;

            if (!$this->wrongAttemptOnWord) {
                // First player timed out — switch to other player
                $this->wrongAttemptOnWord = true;
                $this->currentTurn = $this->currentTurn === 'player1' ? 'player2' : 'player1';
                $nextPlayerName = $this->currentTurn === 'player1' ? $this->player1Name : $this->player2Name;
                $this->turnMessage = "⏰ {$currentPlayerName} kehabisan waktu! Giliran {$nextPlayerName}.";
                $this->userAnswer = '';
                $this->timeLeft = $this->timerDuration;
                $this->dispatchBrowserEvent('reset-timer', ['duration' => $this->timerDuration]);
            } else {
                // Both timed out — skip word
                $this->currentIndex++;
                if ($this->currentIndex >= count($this->words)) {
                    $this->endGame(true);
                } else {
                    $this->turnMessage = '';
                    $this->loadWord();
                }
            }
        } else {
            // Solo mode
            $this->endGame(false);
        }
    }

    // ──────────────────────────────────────────────
    // END GAME & RESET
    // ──────────────────────────────────────────────

    public function endGame($isWin)
    {
        $this->isPlaying = false;
        $this->gameOver = true;
        $this->showPopup = false;
        $this->computerThinking = false;
        $this->turnMessage = '';

        // Determine winner for VS modes
        if ($this->gameMode === 'vs_computer' || $this->gameMode === 'vs_user') {
            $this->scoreEarned = $this->player1Score; // save player1's score to DB

            if ($this->player1Score > $this->player2Score) {
                $this->winner = 'player1';
            } elseif ($this->player2Score > $this->player1Score) {
                $this->winner = 'player2';
            } else {
                $this->winner = 'draw';
            }
        }

        // Save Attempt to Database
        ScrambleAttempt::create([
            'user_id' => Auth::id(),
            'score' => $this->scoreEarned,
            'remaining_time' => max(0, $this->timeLeft),
            'status' => $isWin ? 'win' : 'lose',
            'game_mode' => $this->gameMode ?? 'solo',
        ]);

        // Refresh stats for level unlocking
        $this->loadPlayerStatsAndSettings();
    }

    public function resetGame()
    {
        $this->modeSelected = false;
        $this->showNameInput = false;
        $this->gameMode = null;
        $this->levelSelected = false;
        $this->isPlaying = false;
        $this->gameOver = false;
        $this->showPopup = false;
        $this->computerThinking = false;
        $this->turnMessage = '';
        $this->player1Score = 0;
        $this->player2Score = 0;
        $this->currentTurn = 'player1';
        $this->winner = '';
        $this->scoreEarned = 0;
        $this->wrongAttemptOnWord = false;
        $this->loadPlayerStatsAndSettings();
    }

    public function render()
    {
        return view('livewire.scramble-play');
    }
}
