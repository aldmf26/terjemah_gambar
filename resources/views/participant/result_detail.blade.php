@extends('layouts.admin_layout', ['title' => 'Hasil Quiz'])

@section('content')
    <div class="container">
        <h3>Hasil Quiz: {{ $attempt->quiz->title }}</h3>
        <h5 class="text-muted">Peserta: <b>{{ ucwords($attempt->user->name ?? 'Guest') }}</b></h5>

        <!-- Overall Result -->
        <div class="my-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Total Skor</h5>
                        </div>
                        <div class="card-body text-center">
                            <h4>Total Skor</h4>
                            <h2 class="mb-0">Nilai: <b>{{ $scorePercentage }}%</b></h2>
                            <p class="fw-bold">Total Soal: {{ $totalCorrect }}/{{ $totalQuestions }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Breakdown Per Question -->
        <div class="my-4">
            @foreach ($questions as $question)
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h5>{{ $loop->iteration }}. {{ $question->question_text }}</h5>
                    </div>
                    <div class="card-body">
                        @if ($question->question_type === 'multiple_choice')
                            <h6>Pertanyaan Tipe: Pilihan Ganda</h6>
                            <p>Jawaban Anda: 
    <strong>
        {{ optional($answers->where('question_id', $question->id)->first()->option)->option_text ?? '-' }}
    </strong>
</p>
                            <p>Status:
                                @if ($answers->where('question_id', $question->id)->first()->is_correct)
                                    <span class="badge bg-success">Benar</span>
                                @else
                                    <span class="badge bg-danger">Salah</span>
                                @endif
                            </p>
                            <p>Jawaban yang benar:
                                @foreach ($question->options as $option)
                                    @if ($option->is_correct)
                                        <strong>{{ $option->option_text }}</strong>
                                    @endif
                                @endforeach
                            </p>
                        @elseif($question->question_type === 'true_false')
                            <h6>Pertanyaan Tipe: Benar/Salah</h6>
                            <p>Jawaban Anda:
                                <strong>{{ $answers->where('question_id', $question->id)->first()->answer_text }}</strong>
                            </p>
                            <p>Status:
                                @if ($answers->where('question_id', $question->id)->first()->is_correct)
                                    <span class="text-success">Benar</span>
                                @else
                                    <span class="text-danger">Salah</span>
                                @endif
                            </p>
                            <p>Jawaban yang benar:
                                <strong>{{ $question->options->where('is_correct', true)->first()->option_text }}</strong>
                            </p>
                        @elseif($question->question_type === 'fill_blank')
                            <h6>Pertanyaan Tipe: Isian</h6>
                            <p>Jawaban Anda:
                                <strong>{{ $answers->where('question_id', $question->id)->first()->answer_text }}</strong>
                            </p>
                            <p>Status:
                                @if ($answers->where('question_id', $question->id)->first()->is_correct)
                                    <span class="text-success">Benar</span>
                                @else
                                    <span class="text-danger">Salah</span>
                                @endif
                            </p>
                            <p>Jawaban yang benar:
                                <strong>{{ $question->options->where('is_correct', true)->first()->option_text }}</strong>
                            </p>
                        @elseif($question->question_type === 'matching')
                            <h6>Pertanyaan Tipe: Mencocokkan</h6>
                            <p>Jawaban Anda:
                                <strong>{{ $answers->where('question_id', $question->id)->first()->answer_text }}</strong>
                            </p>
                            <p>Status:
                                @if ($answers->where('question_id', $question->id)->first()->is_correct)
                                    <span class="text-success">Benar</span>
                                @else
                                    <span class="text-danger">Salah</span>
                                @endif
                            </p>
                            <p>Jawaban yang benar:
                                <strong>{{ $question->options->where('is_correct', true)->first()->option_text }}</strong>
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('participant.dashboard') }}" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
    </div>
@endsection
