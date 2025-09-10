<div>
    <h3>{{ $quiz->title }} - {{ ucwords(str_replace('_', ' ', $type)) }}</h3>
    <div class="d-flex justify-content-between align-items-center">

        <h5>Soal: {{ $index }}/{{ $total }}</h5>
        <div class="mb-3 " x-data="{ timer: 15 }" x-init="setInterval(() => { timer > 0 ? timer-- : $wire.next(); }, 10000)">
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
                    <input type="text" wire:model="answers.{{ $question->id }}" class="form-control"
                        placeholder="Jawaban Anda">
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
                    background: #000;
                    z-index: 10;
                }
            </style>
            <div class="row">
                <div class="col-5">
                    @foreach ($questions as $index => $question)
                        <div class="d-flex align-items-center gap-3 mb-3" x-data="{ selected: null }">
                            <div class="card" style="width: 100px; height: 100px;">
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
                                    <button @click="selected = $event.target"
                                        class="btn btn-outline-primary">Pilih</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-2" style="position: relative;">
                    <!-- Connecting lines will be added here dynamically with Alpine.js -->
                    <div x-data="{ lines: [] }" x-init="$watch('lines', (value) => {
                        // Logic to draw lines can be added here
                    })" id="connection-area"></div>
                </div>
                <div class="col-5">
                    @php
                        // Collect all options and shuffle them
                        $allOptions = collect();
                        foreach ($questions as $question) {
                            $allOptions = $allOptions->merge($question->options);
                        }
                        $shuffledOptions = $allOptions->shuffle();
                    @endphp
                    @foreach ($shuffledOptions as $option)
                        <div class="d-flex float-end align-items-center gap-3 mb-3" x-data="{ selected: null }">
                            <div class="card" style="width: 80px; height: 80px;">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <button @click="selected = $event.target"
                                        class="btn btn-outline-primary">Pilih</button>
                                </div>
                            </div>
                            <div class="card" style="width: 100px; height: 100px;">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    {{ $option->option_text }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="d-flex justify-content-between">
            <div>
                @if ($index > 1)
                    <button wire:click="prev" type="button" class="btn btn-secondary"><i class="ti ti-arrow-left"></i>
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
        </div>
    @else
        <p>Tidak ada soal.</p>
    @endif

</div>
