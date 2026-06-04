<div class="w-100 py-4" style="{{ $bgImage ? "background: url('" . asset($bgImage) . "') center/cover fixed;" : 'background-color: #f8f9fa;' }} min-height: 85vh; border-radius: 8px;">
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

    <div class="container">
        {{-- SCREEN 1: MODE SELECTION --}}
        @if (!$modeSelected && !$showNameInput)
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card border-0 shadow-sm" style="{{ $bgImage ? 'background: rgba(255,255,255,0.95);' : '' }}">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold text-primary mb-1">Word Scramble</h3>
                                <p class="text-muted small">Uji Kosakata Lahan Basah Anda</p>
                            </div>

                            <div class="alert alert-info d-flex justify-content-between align-items-center mb-4">
                                <span><i class="ti ti-award me-1"></i> Total Skor</span>
                                <strong class="fs-5">{{ $totalScore }} Poin</strong>
                            </div>

                            <h6 class="fw-bold mb-3 text-secondary">Mode Permainan</h6>

                            <div class="d-grid gap-3">
                                <button wire:click="selectMode('solo')" class="btn btn-outline-primary text-start d-flex justify-content-between align-items-center p-3 rounded-3">
                                    <div>
                                        <div class="fw-bold"><i class="ti ti-user me-2"></i>Solo</div>
                                        <small class="text-muted">Main sendiri, kumpulkan skor tertinggi</small>
                                    </div>
                                    <i class="ti ti-chevron-right"></i>
                                </button>

                                <button wire:click="selectMode('vs_computer')" class="btn btn-outline-danger text-start d-flex justify-content-between align-items-center p-3 rounded-3">
                                    <div>
                                        <div class="fw-bold"><i class="ti ti-device-desktop me-2"></i>Vs Komputer</div>
                                        <small class="text-muted">Lawan AI komputer secara bergantian</small>
                                    </div>
                                    <i class="ti ti-chevron-right"></i>
                                </button>

                                <button wire:click="selectMode('vs_user')" class="btn btn-outline-success text-start d-flex justify-content-between align-items-center p-3 rounded-3">
                                    <div>
                                        <div class="fw-bold"><i class="ti ti-users me-2"></i>Vs Teman</div>
                                        <small class="text-muted">Main bergantian di satu perangkat</small>
                                    </div>
                                    <i class="ti ti-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        {{-- SCREEN 1b: NAME INPUT --}}
        @elseif ($showNameInput)
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <div class="card border-0 shadow-sm" style="{{ $bgImage ? 'background: rgba(255,255,255,0.95);' : '' }}">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h4 class="fw-bold text-primary mb-1">Pemain Vs Teman</h4>
                                <p class="text-muted small">Silakan masukkan nama pemain</p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-secondary">Pemain 1</label>
                                <input type="text" wire:model.defer="player1Name" class="form-control" placeholder="Nama Pemain 1">
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-semibold text-secondary">Pemain 2</label>
                                <input type="text" wire:model.defer="player2Name" class="form-control" placeholder="Nama Pemain 2">
                            </div>

                            <div class="d-grid gap-2">
                                <button wire:click="confirmNames" class="btn btn-primary py-2 fw-semibold">Lanjut ke Level</button>
                                <button wire:click="resetGame" class="btn btn-light text-muted border">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        {{-- SCREEN 2: LEVEL SELECTION --}}
        @elseif (!$levelSelected)
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card border-0 shadow-sm" style="{{ $bgImage ? 'background: rgba(255,255,255,0.95);' : '' }}">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h4 class="fw-bold text-primary mb-0">Pilih Level</h4>
                                    <span class="badge bg-secondary mt-1">
                                        @if ($gameMode === 'solo') Solo @elseif ($gameMode === 'vs_computer') Vs Komputer @elseif ($gameMode === 'vs_user') Vs Teman @endif
                                    </span>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted d-block">Skor Anda</small>
                                    <strong class="text-success fs-5">{{ $totalScore }} Pts</strong>
                                </div>
                            </div>

                            @if (session()->has('error'))
                                <div class="alert alert-danger py-2 mb-4">{{ session('error') }}</div>
                            @endif

                            <div class="d-grid gap-3">
                                {{-- Level 1 --}}
                                <button wire:click="selectLevel(1)" class="btn btn-outline-info text-start d-flex justify-content-between align-items-center p-3 rounded-3">
                                    <div>
                                        <div class="fw-bold">Level 1: Beginner</div>
                                        <small class="text-muted">Kata dasar yang mudah</small>
                                    </div>
                                    <i class="ti ti-chevron-right"></i>
                                </button>

                                {{-- Level 2 --}}
                                <button wire:click="selectLevel(2)" class="btn {{ $isLevel2Unlocked ? 'btn-outline-warning text-dark' : 'btn-light text-muted' }} text-start d-flex justify-content-between align-items-center p-3 rounded-3" {{ !$isLevel2Unlocked ? 'disabled' : '' }}>
                                    <div>
                                        <div class="fw-bold">
                                            Level 2: Intermediate
                                            @if(!$isLevel2Unlocked) <i class="ti ti-lock ms-1"></i> @endif
                                        </div>
                                        <small class="{{ $isLevel2Unlocked ? 'text-muted' : 'text-muted opacity-75' }}">Tingkat kesulitan menengah</small>
                                    </div>
                                    @if($isLevel2Unlocked)
                                        <i class="ti ti-chevron-right"></i>
                                    @else
                                        <span class="badge bg-secondary">Butuh 100 Pts</span>
                                    @endif
                                </button>

                                {{-- Level 3 --}}
                                <button wire:click="selectLevel(3)" class="btn {{ $isLevel3Unlocked ? 'btn-outline-danger' : 'btn-light text-muted' }} text-start d-flex justify-content-between align-items-center p-3 rounded-3" {{ !$isLevel3Unlocked ? 'disabled' : '' }}>
                                    <div>
                                        <div class="fw-bold">
                                            Level 3: Advanced
                                            @if(!$isLevel3Unlocked) <i class="ti ti-lock ms-1"></i> @endif
                                        </div>
                                        <small class="{{ $isLevel3Unlocked ? 'text-muted' : 'text-muted opacity-75' }}">Kata panjang & menantang</small>
                                    </div>
                                    @if($isLevel3Unlocked)
                                        <i class="ti ti-chevron-right"></i>
                                    @else
                                        <span class="badge bg-secondary">Butuh 250 Pts</span>
                                    @endif
                                </button>
                            </div>

                            <button wire:click="resetGame" class="btn btn-link text-muted mt-4 w-100 text-decoration-none">Ganti Mode</button>
                        </div>
                    </div>
                </div>
            </div>

        {{-- SCREEN 3: GAMEPLAY --}}
        @elseif($isPlaying)
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    
                    {{-- Scoreboard for VS Modes --}}
                    @if ($gameMode === 'vs_computer' || $gameMode === 'vs_user')
                        <div class="card border-0 shadow-sm mb-3" style="{{ $bgImage ? 'background: rgba(255,255,255,0.95);' : '' }}">
                            <div class="card-body py-3">
                                <div class="row align-items-center text-center">
                                    <div class="col-5">
                                        <div class="fw-bold text-secondary">{{ $player1Name }}</div>
                                        <div class="fs-4 fw-bold {{ $currentTurn === 'player1' ? 'text-primary' : 'text-dark' }}">{{ $player1Score }}</div>
                                        @if ($currentTurn === 'player1' && !$computerThinking)
                                            <span class="badge bg-primary mt-1">Giliranmu</span>
                                        @endif
                                    </div>
                                    <div class="col-2">
                                        <span class="badge bg-secondary">VS</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="fw-bold text-secondary">{{ $player2Name }}</div>
                                        <div class="fs-4 fw-bold {{ $currentTurn === 'player2' ? 'text-primary' : 'text-dark' }}">{{ $player2Score }}</div>
                                        @if ($currentTurn === 'player2' && !$computerThinking)
                                            <span class="badge bg-primary mt-1">Giliran</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($turnMessage)
                        <div class="alert alert-warning border-0 shadow-sm mb-3 text-center fw-semibold">
                            {{ $turnMessage }}
                        </div>
                    @endif

                    {{-- Main Game Board --}}
                    <div class="card border-0 shadow-sm" style="{{ $bgImage ? 'background: rgba(255,255,255,0.98);' : '' }}">
                        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <span class="badge bg-primary">Level {{ $currentLevel }}</span>
                                <span class="ms-2 text-muted small">Kata {{ $currentIndex + 1 }} / {{ count($words) }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                @if ($gameMode === 'solo' || $gameMode === null)
                                    <span class="fw-bold text-success"><i class="ti ti-trophy"></i> {{ $scoreEarned }}</span>
                                @endif
                                <button wire:click="resetGame" class="btn btn-sm btn-light border"><i class="ti ti-x"></i> Keluar</button>
                            </div>
                        </div>

                        <div class="card-body p-4 p-md-5 text-center" x-data="{ 
                                timeLeft: @entangle('timeLeft'),
                                timerDuration: @entangle('timerDuration'),
                                timerInterval: null,
                                init() {
                                    this.timerInterval = setInterval(() => {
                                        if (this.timeLeft > 0 && $wire.isPlaying && !$wire.showPopup && !$wire.gameOver && !$wire.computerThinking) {
                                            this.timeLeft--;
                                            if (this.timeLeft === 0) {
                                                $wire.handleTimeOut();
                                            }
                                        }
                                    }, 1000);
                                }
                            }">
                            {{-- Timer --}}
                            <div class="mb-5 px-md-5">
                                <div class="d-flex justify-content-between small text-muted mb-1 fw-bold">
                                    <span>Waktu</span>
                                    <span :class="timeLeft <= 10 ? 'text-danger' : 'text-dark'" x-text="Math.max(0, timeLeft) + ' detik'"></span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" 
                                         :class="timeLeft <= 10 ? 'bg-danger' : 'bg-primary'"
                                         :style="'width: ' + ((timeLeft / timerDuration) * 100) + '%; transition: width 1s linear;'"></div>
                                </div>
                            </div>

                            {{-- Scrambled Letters --}}
                            <div class="mb-5">
                                <div class="d-flex justify-content-center flex-wrap gap-2 mb-3">
                                    @foreach ($scrambledLetters as $letter)
                                        <div class="d-flex align-items-center justify-content-center fw-bold rounded shadow-sm text-uppercase bg-light border"
                                             style="width: 65px; height: 65px; font-size: 2.2rem; color: #2c3e50;">
                                            {{ $letter }}
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-muted small">Susun huruf di atas menjadi kata yang tepat.</p>
                            </div>

                            {{-- Computer Thinking --}}
                            @if ($computerThinking)
                                <div class="py-4 text-center">
                                    <div class="spinner-border text-primary mb-2" role="status"></div>
                                    <p class="text-muted mb-0">Komputer sedang berpikir...</p>
                                </div>
                            @endif

                            {{-- Answer Input --}}
                            @if (!$computerThinking)
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-8">
                                        @if (session()->has('game_error'))
                                            <div class="text-danger small mb-2 fw-semibold">{{ session('game_error') }}</div>
                                        @endif

                                        <form wire:submit.prevent="submitAnswer">
                                            <div class="input-group input-group-lg shadow-sm">
                                                <input type="text" wire:model.defer="userAnswer"
                                                       class="form-control text-center text-uppercase fw-bold"
                                                       placeholder="Ketik jawaban..." autofocus>
                                                <button class="btn btn-primary px-4" type="submit">Jawab</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        {{-- SCREEN 4: GAME OVER --}}
        @elseif($gameOver)
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card border-0 shadow-sm text-center" style="{{ $bgImage ? 'background: rgba(255,255,255,0.95);' : '' }}">
                        <div class="card-body p-5">
                            
                            @if ($gameMode === 'vs_computer' || $gameMode === 'vs_user')
                                @if ($winner === 'draw')
                                    <h2 class="fw-bold text-secondary mb-3">Seri!</h2>
                                    <p class="text-muted">Pertandingan berakhir imbang.</p>
                                @elseif ($winner === 'player1')
                                    <h2 class="fw-bold text-success mb-3">{{ $player1Name }} Menang!</h2>
                                @elseif ($winner === 'player2')
                                    <h2 class="fw-bold {{ $gameMode === 'vs_computer' ? 'text-danger' : 'text-success' }} mb-3">{{ $player2Name }} Menang!</h2>
                                @endif

                                <div class="row text-center mt-4 mb-4 pb-3 border-bottom">
                                    <div class="col-5">
                                        <div class="text-muted small">{{ $player1Name }}</div>
                                        <h3 class="fw-bold {{ $winner === 'player1' ? 'text-success' : 'text-dark' }}">{{ $player1Score }}</h3>
                                    </div>
                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <span class="badge bg-secondary">VS</span>
                                    </div>
                                    <div class="col-5">
                                        <div class="text-muted small">{{ $player2Name }}</div>
                                        <h3 class="fw-bold {{ $winner === 'player2' ? 'text-success' : 'text-dark' }}">{{ $player2Score }}</h3>
                                    </div>
                                </div>
                            @else
                                @if ($scoreEarned > 0)
                                    <h2 class="fw-bold text-primary mb-3">Permainan Selesai</h2>
                                    <p class="text-muted">Selamat, Anda berhasil menyelesaikan level ini.</p>
                                @else
                                    <h2 class="fw-bold text-danger mb-3">Waktu Habis</h2>
                                    <p class="text-muted">Jangan menyerah, coba lagi!</p>
                                @endif

                                <div class="my-4">
                                    <h6 class="text-muted mb-1">Skor Akhir</h6>
                                    <h1 class="fw-bold text-success display-5">{{ $scoreEarned }}</h1>
                                </div>
                            @endif

                            <div class="d-grid gap-2 mt-4">
                                <button wire:click="startGame" class="btn btn-primary btn-lg">Main Lagi</button>
                                <button wire:click="resetGame" class="btn btn-light border">Kembali ke Menu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- CORRECT ANSWER EXPLANATION POP-UP --}}
    @if ($showPopup && $currentWord)
        <div class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.5); z-index: 1050;">
            <div class="card border-0 shadow-lg mx-3 w-100" style="max-width: 500px;">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <div class="text-success mb-2"><i class="ti ti-circle-check" style="font-size: 4rem;"></i></div>
                        <h4 class="fw-bold text-success">{{ $popupTitle }}</h4>
                        <h2 class="fw-bold text-dark text-uppercase mt-2">{{ $currentWord['original_word'] }}</h2>
                    </div>

                    @if($currentWord['illustration_image'])
                        <div class="text-center mb-4">
                            <img src="{{ asset($currentWord['illustration_image']) }}" class="img-fluid rounded border" style="max-height: 150px; object-fit: cover;" alt="Ilustrasi">
                        </div>
                    @endif

                    <div class="bg-light p-3 rounded mb-4 border">
                        <h6 class="fw-bold text-primary mb-2">Keterangan:</h6>
                        <p class="mb-0 small text-dark" style="line-height: 1.6;">
                            {{ $currentWord['scientific_description'] }}
                        </p>
                    </div>

                    <div class="d-grid">
                        <button wire:click="nextWord" class="btn btn-primary btn-lg fw-semibold">
                            Lanjut ke Soal Berikutnya <i class="ti ti-arrow-right ms-1"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- JAVASCRIPT ENGINE --}}
    <script>
        document.addEventListener('livewire:load', function () {
            window.addEventListener('computer-thinking', event => {
                const delay = (event.detail && event.detail.delay) ? event.detail.delay : 2000;
                setTimeout(() => {
                    @this.call('processComputerAnswer');
                }, delay);
            });

            window.addEventListener('both-failed-next', event => {
                const delay = (event.detail && event.detail.delay) ? event.detail.delay : 1500;
                setTimeout(() => {
                    @this.call('loadNextAfterBothFailed');
                }, delay);
            });
        });
    </script>
</div>
