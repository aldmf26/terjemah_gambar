<div>
    <h3>{{ $quiz->title }} - {{ ucwords(str_replace('_', ' ', $type)) }}</h3>
    <div class="d-flex justify-content-between align-items-center">

        <h5>Soal: {{ $index }}/{{ $total }}</h5>
        <div class="mb-3 " x-data="{ timer: 15 }" x-init="setInterval(() => { timer > 0 ? timer-- : $wire.next(); }, 1000)">
            <span class="border border-warning align-items-center p-3 d-flex rounded-5 h5" >
                <i class="ti ti-clock me-1"></i>
                <span x-text="`${timer}`"></span>
            </span>
        </div>
    </div>
    @if ($question)
        <div class="mb-4">
            <h5>{{ $question->question_text }}</h5>

            @if ($question->question_type == 'multiple_choice' || $question->question_type == 'true_false')
                <div class="row" x-data="{ selectedOption: null }">
                    @foreach ($question->options->chunk(2) as $chunk)
                        <div class="col-6 cursor-pointer">
                            @foreach ($chunk as $opt)
                                <div class="card rounded-lg mb-3"
                                    :class="{ 'bg-success': selectedOption == {{ $opt->id }} }"
                                    @click="selectedOption = {{ $opt->id }}">
                                    <div class="card-body p-2">
                                        <label class="form-check-label">
                                            <input type="radio" wire:model="answers.{{ $question->id }}"
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

        <div class="d-flex justify-content-between">
            <div>
                @if ($index > 1)
                    <button wire:click="prev" type="button" class="btn btn-secondary"><i
                            class="ti ti-arrow-left"></i> Back </button>
                @endif
            </div>
            <div>
                @if ($index < $total)
                    <button wire:click="next" type="button" class="btn btn-primary">Next <i
                            class="ti ti-arrow-right"></i></button>
                @else
                    <button wire:click="submit" type="button" class="btn btn-success">Finish</button>
                @endif
            </div>
        </div>
    @else
        <p>Tidak ada soal.</p>
    @endif
</div>
