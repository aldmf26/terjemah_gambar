<div>
    <!-- Grid Navigasi Soal -->
    <div class="card mb-4 shadow-sm border-0 bg-light">
        <div class="card-body p-3">
            <h6 class="card-title mb-2"><i class="ti ti-layout-grid"></i> Navigasi Soal</h6>
            <div class="d-flex flex-wrap gap-2">
                @foreach($questions as $idx => $q)
                    @php
                        $isAnswered = isset($answers[$q->id]) || ($type == 'matching' && isset($matches[$q->id]));
                        $isActive = $idx == ($index - 1);
                    @endphp
                    <button wire:click="goToQuestion({{ $idx }})" 
                            class="btn {{ $isActive ? 'btn-primary' : ($isAnswered ? 'btn-success' : 'btn-outline-secondary') }} btn-sm fw-bold"
                            style="width: 40px; height: 40px; border-radius: 8px;">
                        {{ $idx + 1 }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <h3>{{ $quiz->title }} - {{ ucwords(str_replace('_', ' ', $type)) }}</h3>
    <div class="d-flex justify-content-between align-items-center">

        <h5>Soal: {{ $index }}/{{ $total }}</h5>
        <div class="mb-3 " x-data="{ timer: {{ $total * 10 }} }" x-init="setInterval(() => { timer > 0 ? timer-- : $wire.next(); }, 1000)">
            <span class="border border-warning align-items-center p-3 d-flex rounded-5 h5">
                <i class="ti ti-clock me-1"></i>
                <span x-text="`${timer}`"></span>
            </span>
        </div>
    </div>
    @if ($question)
        @if ($question->question_type != 'matching')
            <div class="mb-4">
                <h5>{{ $question->question_text }}</h5>

                @if ($question->question_type == 'multiple_choice' || $question->question_type == 'true_false')
                    <div class="row" x-data="{
                        selectedOption: @js($answers[$question->id] ?? null),
                        selectOption(optionId) {
                            this.selectedOption = optionId;
                            $wire.set('answers.{{ $question->id }}', optionId);
                        }
                    }" x-init="$watch('selectedOption', value => $wire.set('answers.{{ $question->id }}', value))">
                        @foreach ($question->options->chunk(2) as $chunk)
                            <div class="col-6 cursor-pointer">
                                @foreach ($chunk as $opt)
                                    <div class="card rounded-lg mb-3"
                                        :class="{ 'bg-success': selectedOption == {{ $opt->id }} }"
                                        @click="selectOption({{ $opt->id }})">
                                        <div class="card-body p-2">
                                            <label class="form-check-label cursor-pointer">
                                                <input type="radio" wire:model.live="answers.{{ $question->id }}"
                                                    value="{{ $opt->id }}" class="form-check-input me-2"
                                                    x-bind:checked="selectedOption == {{ $opt->id }}">
                                                {{ $opt->option_text }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @elseif($question->question_type == 'fill_blank')
                    <input type="text" wire:model.live="answers.{{ $question->id }}" class="form-control"
                        placeholder="Jawaban Anda">
                @endif
                
                <!-- Feedback Validation -->
                @if(isset($results[$question->id]))
                    <div class="mt-3 alert {{ $results[$question->id]['is_correct'] ? 'alert-success' : 'alert-danger' }}">
                        @if($results[$question->id]['is_correct'])
                            <h6 class="mb-0 text-success"><i class="ti ti-check text-success"></i> Jawaban Anda Benar!</h6>
                        @else
                            <h6 class="mb-0 text-danger"><i class="ti ti-x text-danger"></i> Jawaban Anda Salah. Jawaban yang benar adalah: <br><strong>{{ $results[$question->id]['correct_text'] }}</strong></h6>
                        @endif
                    </div>
                @endif
            </div>
        @else
            <style>
                .card {
                    border: 1px solid #dee2e6;
                    border-radius: 0.25rem;
                    text-align: center;
                }

                .card-body {
                    padding: 0.5rem;
                    height: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                #connection-area {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    pointer-events: none;
                }

                .line {
                    position: absolute;
                    height: 2px;
                    background: #0d6efd;
                    transform-origin: left center;
                }
            </style>
            <div class="row" x-data="matchingGame()" x-init="init()">
                <div class="col-5">
                    @foreach ($questions as $index => $question)
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="card" style="width: 100px; height: 100px;" x-ref="left{{ $question->id }}">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    @if (stripos($question->question_text, 'jpg') !== false ||
                                            stripos($question->question_text, 'jpeg') !== false ||
                                            stripos($question->question_text, 'png') !== false ||
                                            stripos($question->question_text, 'webp') !== false)
                                        <img class="mx-auto" style="max-width: 100%; max-height: 100%;"
                                            src="{{ asset('/uploads/questions/' . $question->question_text) }}">
                                    @else
                                        {{ $question->question_text }}
                                    @endif
                                </div>
                            </div>
                            <div class="card" style="width: 80px; height: 80px;">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <button @click="selectLeft({{ $question->id }})"
                                        :class="matches[{{ $question->id }}] ? 'btn btn-success' :
                                            (selectedLeft === {{ $question->id }} ? 'btn btn-primary' :
                                                'btn btn-outline-primary')"
                                        :disabled="matches[{{ $question->id }}]">
                                        <span x-text="matches[{{ $question->id }}] ? 'Selesai' : 'Pilih'"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Area garis --}}
                <div class="col-2 position-relative" style="min-height: 400px;">
                    <div id="connection-area" x-ref="connectionArea">
                        <template x-for="(line, i) in lines" :key="i">
                            <div class="line"
                                :style="{
                                    left: line.x + 'px',
                                    top: line.y + 'px',
                                    width: line.length + 'px',
                                    transform: 'rotate(' + line.angle + 'rad)'
                                }">
                            </div>
                        </template>
                    </div>
                </div>
                <div class="col-5">
                    @foreach ($optionsMatching as $key => $opt)
                        <div class="d-flex float-end align-items-center gap-3 mb-3">
                            <div class="card" style="width: 80px; height: 80px;">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <button @click="chooseRight({{ $opt['id'] }})"
                                        :class="rightMatched[{{ $opt['id'] }}] ? 'btn btn-success' :
                                            'btn btn-outline-primary'"
                                        :disabled="rightMatched[{{ $opt['id'] }}]">
                                        <span
                                            x-text="rightMatched[{{ $opt['id'] }}] ? 'Dipasangkan' : 'Pilih'"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="card" style="width: 100px; height: 100px;" x-ref="right{{ $opt['id'] }}">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    {{ $opt['text'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                    <button @click="resetMatching" type="button" class="btn btn-warning"><i
                            class="ti ti-refresh"></i>
                        Reset</button>
                </div>
                <button wire:click="submit" type="button" @if(!$completed) disabled @endif class="btn btn-success">Finish <i
                        class="ti ti-check"></i></button>
                </div>
            
            </div>

            <script>
                function matchingGame() {
                    return {
                        selectedLeft: null,
                        lines: [],
                        matches: {}, // Track pasangan yang sudah dibuat
                        rightMatched: {}, // Track right items yang sudah dipasangkan

                        init() {
                            this.lines = [];
                            this.matches = {};
                            this.rightMatched = {};
                        },

                        selectLeft(id) {
                            // Jika item sudah dipasangkan, tidak bisa dipilih lagi
                            if (this.matches[id]) return;

                            this.selectedLeft = id;
                        },

                        chooseRight(rid) {
                            if (!this.selectedLeft) return;

                            // Cek apakah left item sudah dipasangkan
                            if (this.matches[this.selectedLeft]) return;

                            // Cek apakah right item sudah dipasangkan
                            if (this.rightMatched[rid]) return;

                            // === Panggil Livewire dulu ===
                            @this.call('selectMatch', this.selectedLeft, rid);

                            // Simpan pasangan
                            this.matches[this.selectedLeft] = rid;
                            this.rightMatched[rid] = this.selectedLeft;

                            // Ambil posisi kiri dan kanan
                            const leftEl = this.$refs['left' + this.selectedLeft];
                            const rightEl = this.$refs['right' + rid];
                            if (!leftEl || !rightEl) return;

                            // Titik tengah tiap kartu (relatif ke dokumen)
                            const lRect = leftEl.getBoundingClientRect();
                            const rRect = rightEl.getBoundingClientRect();

                            // Parent area untuk garis
                            const areaRect = this.$refs.connectionArea.getBoundingClientRect();

                            // Titik awal dan akhir (relatif ke area garis)
                            const lX = lRect.right - areaRect.left;
                            const lY = lRect.top + lRect.height / 2 - areaRect.top;
                            const rX = rRect.left - areaRect.left;
                            const rY = rRect.top + rRect.height / 2 - areaRect.top;

                            // Hitung jarak & sudut
                            const dx = rX - lX;
                            const dy = rY - lY;
                            const length = Math.sqrt(dx * dx + dy * dy);
                            const angle = Math.atan2(dy, dx);

                            // Simpan garis
                            this.lines.push({
                                x: lX,
                                y: lY,
                                length,
                                angle
                            });

                            // Reset pilihan
                            this.selectedLeft = null;
                        },
                        resetMatching() {
                            this.selectedLeft = null;
                            this.lines = [];
                            this.matches = {};
                            this.rightMatched = {};
                        },
                    }
                }
            </script>
        @endif

        <div class="d-flex justify-content-between">
            @if ($question->question_type != 'matching')
                <div>
                    @if ($index > 1)
                        <button wire:click="prev" type="button" class="btn btn-secondary"><i
                                class="ti ti-arrow-left"></i>
                            Back </button>
                    @endif
                </div>
                <div>
                    @if ($index < $total)
                        <button wire:click="next" type="button" class="btn btn-primary">Next <i
                                class="ti ti-arrow-right"></i></button>
                    @else
                        <button wire:click="submit" type="button" class="btn btn-success">Finish <i
                                class="ti ti-check"></i></button>
                    @endif
                </div>
            @endif
        </div>
    @else
        <p>Tidak ada soal.</p>
    @endif

</div>
