<div class="w-100 py-3" style="
    background: {{ $bgImage ? 'url(' . asset($bgImage) . ')' : 'linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%)' }};
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 85vh;
    border-radius: 15px;
">
    {{-- Background Music --}}
    @if ($bgMusic && $isPlaying)
        <audio id="scrambleBgMusic" src="{{ asset($bgMusic) }}" autoplay loop style="display: none;"></audio>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const music = document.getElementById('scrambleBgMusic');
                if (music) {
                    music.volume = 0.3;
                    music.play().catch(e => console.log("Autoplay blocked by browser."));
                }
            });
        </script>
    @endif

    <div class="container py-4">

        {{-- ╔══════════════════════════════════════════╗ --}}
        {{-- ║       SCREEN 1: MODE SELECTION           ║ --}}
        {{-- ╚══════════════════════════════════════════╝ --}}
        @if (!$modeSelected && !$showNameInput)
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-7">
                    <div class="card border-0 rounded-4 shadow-lg text-white" style="background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(15px);">
                        <div class="card-body p-5 text-center">
                            <h2 class="fw-bold mb-1">🧩 Word Scramble</h2>
                            <p class="text-white-50 small mb-2">Susun huruf menjadi kata bertema Lahan Basah (Wetland)</p>

                            <div class="mb-4 bg-dark bg-opacity-25 p-3 rounded-3 d-flex align-items-center justify-content-between">
                                <span class="small fw-semibold"><i class="ti ti-award me-1 text-warning"></i>Total Skor Anda:</span>
                                <span class="fs-5 fw-bold text-warning">{{ $totalScore }} Poin</span>
                            </div>

                            <h5 class="fw-bold mb-3 text-start"><i class="ti ti-controller me-1"></i>Pilih Mode Permainan:</h5>

                            <div class="d-grid gap-3">
                                {{-- Solo Mode --}}
                                <button wire:click="selectMode('solo')" class="btn btn-lg text-start d-flex justify-content-between align-items-center py-3 px-4 rounded-3 shadow-sm border-0 text-white"
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease;"
                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(102,126,234,0.4)'"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                    <div>
                                        <h5 class="fw-bold mb-0"><i class="ti ti-user me-2"></i>Solo</h5>
                                        <small class="text-white-50">Main sendiri, kumpulkan skor tertinggi</small>
                                    </div>
                                    <i class="ti ti-chevron-right fs-4"></i>
                                </button>

                                {{-- VS Komputer --}}
                                <button wire:click="selectMode('vs_computer')" class="btn btn-lg text-start d-flex justify-content-between align-items-center py-3 px-4 rounded-3 shadow-sm border-0 text-white"
                                        style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); transition: all 0.3s ease;"
                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(245,87,108,0.4)'"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                    <div>
                                        <h5 class="fw-bold mb-0"><i class="ti ti-robot me-2"></i>vs Komputer</h5>
                                        <small class="text-white-50">Lawan AI komputer secara bergantian</small>
                                    </div>
                                    <i class="ti ti-chevron-right fs-4"></i>
                                </button>

                                {{-- VS User --}}
                                <button wire:click="selectMode('vs_user')" class="btn btn-lg text-start d-flex justify-content-between align-items-center py-3 px-4 rounded-3 shadow-sm border-0 text-white"
                                        style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); transition: all 0.3s ease;"
                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(79,172,254,0.4)'"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                    <div>
                                        <h5 class="fw-bold mb-0"><i class="ti ti-users me-2"></i>vs Teman</h5>
                                        <small class="text-white-50">Main bergantian dengan teman di satu perangkat</small>
                                    </div>
                                    <i class="ti ti-chevron-right fs-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        {{-- ╔══════════════════════════════════════════╗ --}}
        {{-- ║    SCREEN 1b: NAME INPUT (vs User)       ║ --}}
        {{-- ╚══════════════════════════════════════════╝ --}}
        @elseif ($showNameInput)
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="card border-0 rounded-4 shadow-lg text-white" style="background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(15px);">
                        <div class="card-body p-5 text-center">
                            <h3 class="fw-bold mb-1"><i class="ti ti-users me-2"></i>vs Teman</h3>
                            <p class="text-white-50 small mb-4">Masukkan nama kedua pemain</p>

                            <div class="mb-3 text-start">
                                <label class="form-label small fw-semibold text-info"><i class="ti ti-user me-1"></i>Nama Pemain 1</label>
                                <input type="text" wire:model.defer="player1Name" class="form-control form-control-lg bg-dark bg-opacity-50 text-white border-secondary rounded-3" placeholder="Pemain 1">
                            </div>
                            <div class="mb-4 text-start">
                                <label class="form-label small fw-semibold text-warning"><i class="ti ti-user me-1"></i>Nama Pemain 2</label>
                                <input type="text" wire:model.defer="player2Name" class="form-control form-control-lg bg-dark bg-opacity-50 text-white border-secondary rounded-3" placeholder="Pemain 2">
                            </div>

                            <div class="d-grid gap-2">
                                <button wire:click="confirmNames" class="btn btn-lg btn-primary rounded-3 py-3 fw-bold shadow">
                                    <i class="ti ti-arrow-right me-1"></i> Lanjut Pilih Level
                                </button>
                                <button wire:click="resetGame" class="btn btn-sm btn-outline-light mt-1">
                                    <i class="ti ti-arrow-left me-1"></i> Kembali
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        {{-- ╔══════════════════════════════════════════╗ --}}
        {{-- ║      SCREEN 2: LEVEL SELECTION           ║ --}}
        {{-- ╚══════════════════════════════════════════╝ --}}
        @elseif (!$levelSelected)
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card border-0 rounded-4 shadow-lg text-white" style="background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(15px);">
                        <div class="card-body p-5 text-center">
                            {{-- Mode Badge --}}
                            <div class="mb-3">
                                @if ($gameMode === 'solo')
                                    <span class="badge px-3 py-2 rounded-pill" style="background: linear-gradient(135deg, #667eea, #764ba2);"><i class="ti ti-user me-1"></i> Mode Solo</span>
                                @elseif ($gameMode === 'vs_computer')
                                    <span class="badge px-3 py-2 rounded-pill" style="background: linear-gradient(135deg, #f093fb, #f5576c);"><i class="ti ti-robot me-1"></i> vs Komputer</span>
                                @elseif ($gameMode === 'vs_user')
                                    <span class="badge px-3 py-2 rounded-pill" style="background: linear-gradient(135deg, #4facfe, #00f2fe);"><i class="ti ti-users me-1"></i> {{ $player1Name }} vs {{ $player2Name }}</span>
                                @endif
                            </div>

                            <h2 class="fw-bold mb-2">🧩 Word Scramble</h2>
                            <p class="text-white-50 small mb-4">Susun huruf menjadi kata bertema Lahan Basah (Wetland)</p>

                            <div class="mb-4 bg-dark bg-opacity-25 p-3 rounded-3 d-flex align-items-center justify-content-between">
                                <span class="small fw-semibold"><i class="ti ti-award me-1 text-warning"></i>Total Skor Anda:</span>
                                <span class="fs-5 fw-bold text-warning">{{ $totalScore }} Poin</span>
                            </div>

                            @if (session()->has('error'))
                                <div class="alert alert-danger border-0 small py-2 mb-4">{{ session('error') }}</div>
                            @endif

                            <h5 class="fw-bold mb-3 text-start">Pilih Tingkat Level:</h5>
                            <div class="d-grid gap-3">
                                {{-- Level 1 --}}
                                <button wire:click="selectLevel(1)" class="btn btn-info btn-lg text-white text-start d-flex justify-content-between align-items-center py-3 px-4 rounded-3 shadow-sm border-0">
                                    <div>
                                        <h5 class="fw-bold mb-0">Level 1: Beginner</h5>
                                        <small class="text-white-50">Kata-kata dasar mudah ditebak</small>
                                    </div>
                                    <i class="ti ti-chevron-right fs-5"></i>
                                </button>

                                {{-- Level 2 --}}
                                <button wire:click="selectLevel(2)" class="btn {{ $isLevel2Unlocked ? 'btn-warning' : 'btn-secondary opacity-75' }} btn-lg text-start d-flex justify-content-between align-items-center py-3 px-4 rounded-3 shadow-sm border-0" {{ !$isLevel2Unlocked ? 'disabled' : '' }}>
                                    <div>
                                        <h5 class="fw-bold mb-0 text-dark">
                                            Level 2: Intermediate
                                            @if(!$isLevel2Unlocked) <i class="ti ti-lock ms-1"></i> @endif
                                        </h5>
                                        <small class="{{ $isLevel2Unlocked ? 'text-dark-50' : 'text-white-50' }}">Tingkat kesulitan menengah</small>
                                    </div>
                                    @if($isLevel2Unlocked)
                                        <i class="ti ti-chevron-right text-dark fs-5"></i>
                                    @else
                                        <span class="badge bg-dark small">Butuh 100 Poin</span>
                                    @endif
                                </button>

                                {{-- Level 3 --}}
                                <button wire:click="selectLevel(3)" class="btn {{ $isLevel3Unlocked ? 'btn-danger' : 'btn-secondary opacity-75' }} btn-lg text-white text-start d-flex justify-content-between align-items-center py-3 px-4 rounded-3 shadow-sm border-0" {{ !$isLevel3Unlocked ? 'disabled' : '' }}>
                                    <div>
                                        <h5 class="fw-bold mb-0">
                                            Level 3: Advanced
                                            @if(!$isLevel3Unlocked) <i class="ti ti-lock ms-1"></i> @endif
                                        </h5>
                                        <small class="text-white-50">Kata panjang & menantang</small>
                                    </div>
                                    @if($isLevel3Unlocked)
                                        <i class="ti ti-chevron-right fs-5"></i>
                                    @else
                                        <span class="badge bg-dark small text-white">Butuh 250 Poin</span>
                                    @endif
                                </button>
                            </div>

                            <button wire:click="resetGame" class="btn btn-sm btn-outline-light mt-4">
                                <i class="ti ti-arrow-left me-1"></i> Ganti Mode
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        {{-- ╔══════════════════════════════════════════╗ --}}
        {{-- ║       SCREEN 3: GAMEPLAY                 ║ --}}
        {{-- ╚══════════════════════════════════════════╝ --}}
        @elseif($isPlaying)
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">

                    {{-- VS Scoreboard (only for vs modes) --}}
                    @if ($gameMode === 'vs_computer' || $gameMode === 'vs_user')
                        <div class="card border-0 rounded-4 shadow mb-3 text-white" style="background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(10px);">
                            <div class="card-body py-3 px-4">
                                <div class="row align-items-center text-center">
                                    {{-- Player 1 --}}
                                    <div class="col-5">
                                        <div class="d-flex align-items-center justify-content-center gap-2 {{ $currentTurn === 'player1' ? '' : 'opacity-50' }}">
                                            <div>
                                                <div class="fw-bold {{ $currentTurn === 'player1' ? 'text-info' : '' }}">
                                                    <i class="ti ti-user me-1"></i>{{ $player1Name }}
                                                </div>
                                                <div class="fs-4 fw-bold text-warning">{{ $player1Score }}</div>
                                            </div>
                                            @if ($currentTurn === 'player1' && !$computerThinking)
                                                <span class="badge bg-info rounded-pill px-2 py-1 ms-1" style="animation: pulse 1.5s infinite; font-size: 0.65rem;">GILIRAN</span>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- VS --}}
                                    <div class="col-2">
                                        <span class="badge bg-danger rounded-pill px-3 py-2 fs-6 fw-bold">VS</span>
                                    </div>
                                    {{-- Player 2 --}}
                                    <div class="col-5">
                                        <div class="d-flex align-items-center justify-content-center gap-2 {{ $currentTurn === 'player2' ? '' : 'opacity-50' }}">
                                            @if ($currentTurn === 'player2' && !$computerThinking)
                                                <span class="badge bg-warning text-dark rounded-pill px-2 py-1 me-1" style="animation: pulse 1.5s infinite; font-size: 0.65rem;">GILIRAN</span>
                                            @endif
                                            <div>
                                                <div class="fw-bold {{ $currentTurn === 'player2' ? 'text-warning' : '' }}">
                                                    @if ($gameMode === 'vs_computer')
                                                        <i class="ti ti-robot me-1"></i>
                                                    @else
                                                        <i class="ti ti-user me-1"></i>
                                                    @endif
                                                    {{ $player2Name }}
                                                </div>
                                                <div class="fs-4 fw-bold text-warning">{{ $player2Score }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Turn Message Alert --}}
                    @if ($turnMessage)
                        <div class="alert border-0 rounded-3 shadow-sm mb-3 py-2 text-center fw-semibold text-white" style="background: rgba(255, 193, 7, 0.25); backdrop-filter: blur(5px); border: 1px solid rgba(255, 193, 7, 0.3) !important;">
                            {{ $turnMessage }}
                        </div>
                    @endif

                    {{-- Glassmorphism Game Board --}}
                    <div class="card border-0 rounded-4 shadow-lg text-white" style="background: rgba(255, 255, 255, 0.12); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.2) !important;">
                        <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 px-4">
                            <div>
                                <span class="badge bg-primary px-3 py-2 fs-6">Level {{ $currentLevel }}</span>
                                <span class="ms-2 text-white-50 small">Kata {{ $currentIndex + 1 }} dari {{ count($words) }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                @if ($gameMode === 'solo' || $gameMode === null)
                                    <div class="bg-dark bg-opacity-50 px-3 py-2 rounded-3 text-warning fw-bold">
                                        <i class="ti ti-trophy me-1"></i> {{ $scoreEarned }} Pts
                                    </div>
                                @endif
                                <button wire:click="resetGame" class="btn btn-sm btn-outline-light"><i class="ti ti-home"></i> Menu</button>
                            </div>
                        </div>

                        <div class="card-body p-4 text-center">
                            {{-- Visual Timer --}}
                            <div class="mb-4">
                                <div class="d-flex justify-content-between small text-white-50 mb-1">
                                    <span>Sisa Waktu</span>
                                    <span class="fw-bold {{ $timeLeft <= 10 ? 'text-danger' : 'text-white' }}" style="{{ $timeLeft <= 10 ? 'animation: pulse 0.8s infinite;' : '' }}">{{ $timeLeft }} detik</span>
                                </div>
                                <div class="progress" style="height: 10px; background-color: rgba(255,255,255,0.15);">
                                    <div class="progress-bar {{ $timeLeft <= 10 ? 'bg-danger' : ($timeLeft <= 20 ? 'bg-warning' : 'bg-success') }}" role="progressbar"
                                         style="width: {{ ($timeLeft / $timerDuration) * 100 }}%; transition: width 1s linear;"></div>
                                </div>
                            </div>

                            {{-- Current Turn Indicator (inline, for vs_user) --}}
                            @if ($gameMode === 'vs_user')
                                <div class="mb-3">
                                    <span class="badge rounded-pill px-3 py-2 fs-6" style="background: linear-gradient(135deg, {{ $currentTurn === 'player1' ? '#4facfe, #00f2fe' : '#f093fb, #f5576c' }});">
                                        <i class="ti ti-{{ $currentTurn === 'player1' ? 'user' : 'user' }} me-1"></i>
                                        Giliran: {{ $currentTurn === 'player1' ? $player1Name : $player2Name }}
                                    </span>
                                </div>
                            @endif

                            {{-- Scrambled Letters Box --}}
                            <div class="py-4 my-2">
                                <div class="d-flex justify-content-center flex-wrap gap-2 mb-3">
                                    @foreach ($scrambledLetters as $letter)
                                        <div class="d-flex align-items-center justify-content-center fw-bold rounded-3 shadow-sm text-uppercase"
                                             style="width: 55px; height: 55px; font-size: 1.8rem; pointer-events: none; background: linear-gradient(180deg, #ffd54f, #ffb300); color: #3e2723; border: 2px solid rgba(255,255,255,0.6);">
                                            {{ $letter }}
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-white-50 small mb-0">Susun huruf di atas menjadi kata yang benar!</p>
                            </div>

                            {{-- Computer Thinking Overlay --}}
                            @if ($computerThinking)
                                <div class="my-3 py-4">
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <div class="spinner-border text-warning" role="status" style="width: 2rem; height: 2rem;">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-warning fs-5">🤖 Komputer sedang berpikir...</div>
                                            <div class="text-white-50 small">Menunggu jawaban komputer</div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Input Form (hidden when computer is thinking) --}}
                            @if (!$computerThinking)
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-8">
                                        @if (session()->has('game_error'))
                                            <div class="alert alert-danger border-0 small py-2 mb-3 text-center">{{ session('game_error') }}</div>
                                        @endif

                                        <form wire:submit.prevent="submitAnswer">
                                            <div class="input-group input-group-lg mb-3 shadow">
                                                <input type="text" wire:model.defer="userAnswer"
                                                       class="form-control text-center text-uppercase border-0 fw-bold"
                                                       placeholder="Ketik jawaban di sini..." autofocus
                                                       style="letter-spacing: 2px;">
                                                <button class="btn btn-primary px-4" type="submit">
                                                    <i class="ti ti-arrow-right"></i> Jawab
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        {{-- ╔══════════════════════════════════════════╗ --}}
        {{-- ║       SCREEN 4: GAME OVER                ║ --}}
        {{-- ╚══════════════════════════════════════════╝ --}}
        @elseif($gameOver)
            <div class="row justify-content-center">
                <div class="col-12 col-md-7 col-lg-6">
                    <div class="card border-0 rounded-4 shadow-lg text-white text-center" style="background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(15px);">
                        <div class="card-body p-5">

                            {{-- VS MODE GAME OVER --}}
                            @if ($gameMode === 'vs_computer' || $gameMode === 'vs_user')
                                @if ($winner === 'draw')
                                    <h1 class="display-3 mb-2">🤝</h1>
                                    <h3 class="fw-bold mb-3 text-warning">Seri!</h3>
                                    <p class="text-white-50">Pertandingan berakhir imbang. Coba lagi!</p>
                                @elseif ($winner === 'player1')
                                    <h1 class="display-3 mb-2">🏆</h1>
                                    <h3 class="fw-bold mb-3 text-success">{{ $player1Name }} Menang!</h3>
                                    <p class="text-white-50">Selamat, {{ $player1Name }} berhasil mengalahkan {{ $player2Name }}!</p>
                                @elseif ($winner === 'player2')
                                    <h1 class="display-3 mb-2">
                                        @if ($gameMode === 'vs_computer') 🤖 @else 🏆 @endif
                                    </h1>
                                    <h3 class="fw-bold mb-3 {{ $gameMode === 'vs_computer' ? 'text-danger' : 'text-success' }}">{{ $player2Name }} Menang!</h3>
                                    @if ($gameMode === 'vs_computer')
                                        <p class="text-white-50">Komputer mengalahkanmu kali ini. Jangan menyerah!</p>
                                    @else
                                        <p class="text-white-50">Selamat, {{ $player2Name }} berhasil menang!</p>
                                    @endif
                                @endif

                                {{-- VS Score Summary --}}
                                <div class="my-4 bg-light bg-opacity-10 p-4 rounded-3">
                                    <div class="row text-center">
                                        <div class="col-5">
                                            <div class="small text-white-50 mb-1">
                                                <i class="ti ti-user me-1"></i>{{ $player1Name }}
                                            </div>
                                            <h2 class="fw-bold {{ $winner === 'player1' ? 'text-success' : 'text-white' }}">{{ $player1Score }}</h2>
                                        </div>
                                        <div class="col-2 d-flex align-items-center justify-content-center">
                                            <span class="badge bg-danger rounded-pill px-2 py-1">VS</span>
                                        </div>
                                        <div class="col-5">
                                            <div class="small text-white-50 mb-1">
                                                @if ($gameMode === 'vs_computer')
                                                    <i class="ti ti-robot me-1"></i>
                                                @else
                                                    <i class="ti ti-user me-1"></i>
                                                @endif
                                                {{ $player2Name }}
                                            </div>
                                            <h2 class="fw-bold {{ $winner === 'player2' ? 'text-success' : 'text-white' }}">{{ $player2Score }}</h2>
                                        </div>
                                    </div>
                                </div>

                            {{-- SOLO MODE GAME OVER --}}
                            @else
                                @if ($scoreEarned > 0)
                                    <h1 class="display-3 mb-2">🎉 Hore!</h1>
                                    <h4 class="fw-bold mb-3">Permainan Selesai</h4>
                                    <p class="text-white-50">Selamat! Anda berhasil menyelesaikan tantangan level ini.</p>
                                @else
                                    <h1 class="display-3 mb-2 text-danger">⏰ Yahh!</h1>
                                    <h4 class="fw-bold mb-3 text-danger">Waktu Habis</h4>
                                    <p class="text-white-50">Sayang sekali waktunya keburu habis.</p>
                                @endif

                                <div class="my-4 bg-light bg-opacity-10 p-4 rounded-3">
                                    <h6 class="text-white-50">Skor Diperoleh:</h6>
                                    <h2 class="fw-bold text-warning">{{ $scoreEarned }} Poin</h2>
                                </div>
                            @endif

                            <div class="d-grid gap-2">
                                <button wire:click="startGame" class="btn btn-primary btn-lg rounded-3 py-3"><i class="ti ti-refresh me-1"></i> Main Lagi</button>
                                <button wire:click="resetGame" class="btn btn-outline-light btn-lg rounded-3 py-3"><i class="ti ti-home me-1"></i> Kembali ke Menu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- ╔══════════════════════════════════════════╗ --}}
    {{-- ║   CORRECT ANSWER EXPLANATION POP-UP      ║ --}}
    {{-- ╚══════════════════════════════════════════╝ --}}
    @if ($showPopup && $currentWord)
        <div class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.6); z-index: 1050; backdrop-filter: blur(8px);">
            <div class="card border-0 rounded-4 text-white shadow-lg mx-3 w-100" style="max-width: 550px; background: rgba(30, 41, 59, 0.95);">
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <div class="display-5 text-success mb-2">
                            <i class="ti ti-circle-check"></i>
                        </div>
                        <h4 class="fw-bold text-success">{{ $popupTitle }}</h4>
                        <h2 class="fw-bold text-warning text-uppercase mt-1 mb-3" style="letter-spacing: 2px;">{{ $currentWord['original_word'] }}</h2>
                    </div>

                    @if($currentWord['illustration_image'])
                        <div class="text-center mb-3">
                            <img src="{{ asset($currentWord['illustration_image']) }}" class="img-fluid rounded border border-secondary shadow-sm" style="max-height: 180px; object-fit: cover;" alt="Ilustrasi">
                        </div>
                    @endif

                    <div class="bg-dark bg-opacity-25 p-3 rounded-3 mb-4">
                        <h6 class="fw-bold text-info mb-1"><i class="ti ti-info-circle me-1"></i>Penjelasan Ilmiah:</h6>
                        <p class="mb-0 small text-white-50 text-start" style="line-height: 1.6;">
                            {{ $currentWord['scientific_description'] }}
                        </p>
                    </div>

                    <div class="d-grid">
                        <button wire:click="nextWord" class="btn btn-success btn-lg rounded-3 py-2 fw-semibold">
                            Lanjut <i class="ti ti-arrow-right ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ╔══════════════════════════════════════════╗ --}}
    {{-- ║          JAVASCRIPT ENGINE                ║ --}}
    {{-- ╚══════════════════════════════════════════╝ --}}
    <script>
        document.addEventListener('livewire:load', function () {
            let timerId = null;

            function startTimer() {
                clearInterval(timerId);
                timerId = setInterval(() => {
                    // Don't tick when popup, game over, or computer is thinking
                    if (@this.isPlaying && !@this.showPopup && !@this.gameOver && !@this.computerThinking) {
                        if (@this.timeLeft > 0) {
                            @this.timeLeft--;
                            @this.set('timeLeft', @this.timeLeft);
                        } else {
                            clearInterval(timerId);
                            @this.emit('timerExpired');
                        }
                    }
                }, 1000);
            }

            // Reset timer (called when new word loads or turn switches)
            window.addEventListener('reset-timer', event => {
                startTimer();
            });

            // Computer thinking delay — after delay, call processComputerAnswer on server
            window.addEventListener('computer-thinking', event => {
                clearInterval(timerId); // pause timer while computer thinks
                const delay = (event.detail && event.detail.delay) ? event.detail.delay : 2000;
                setTimeout(() => {
                    @this.call('processComputerAnswer');
                }, delay);
            });

            // Both players failed — small delay then load next word
            window.addEventListener('both-failed-next', event => {
                clearInterval(timerId);
                const delay = (event.detail && event.detail.delay) ? event.detail.delay : 1500;
                setTimeout(() => {
                    @this.call('loadNextAfterBothFailed');
                }, delay);
            });

            // Start timer if game is already playing on page load
            if (@this.isPlaying) {
                startTimer();
            }
        });
    </script>

    {{-- Pulse animation for turn badges and critical timer --}}
    <style>
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.05); }
        }
    </style>
</div>
