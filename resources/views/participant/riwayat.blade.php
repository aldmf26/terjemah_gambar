@extends('layouts.admin_layout', ['title' => 'Dashboard'])
@section('content')
    <h3 class="mb-4">Dashboard Peserta</h3>

    <div class="row">
        @foreach ($quizzes as $quiz)
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden; transition: transform 0.2s;">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title fw-bold text-primary mb-0">
                                <i class="ti ti-clipboard-list me-2"></i>{{ $quiz->title }}
                            </h5>
                            <span class="badge bg-light text-dark border"><i class="ti ti-question-mark me-1"></i> {{ $quiz->questions_count }} Soal</span>
                        </div>
                        
                        <p class="text-muted small mb-3">
                            Tipe soal yang tersedia dalam quiz ini:
                        </p>
                        
                        <div class="mb-4">
                            @foreach ($quiz->questions->groupBy('question_type')->sortBy(function ($item, $key) {
                                $order = ['multiple_choice', 'true_false', 'fill_blank', 'matching'];
                                return array_search($key, $order);
                            }) as $type => $questions)
                                @php
                                    $icon = 'ti-circle';
                                    if($type == 'multiple_choice') $icon = 'ti-list-check';
                                    if($type == 'true_false') $icon = 'ti-check';
                                    if($type == 'fill_blank') $icon = 'ti-writing';
                                    if($type == 'matching') $icon = 'ti-arrows-join-2';
                                @endphp
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 me-1 mb-2 px-3 py-2" style="border-radius: 20px;">
                                    <i class="ti {{ $icon }} me-1"></i> {{ ucwords(str_replace('_', ' ', $type)) }} 
                                    <span class="ms-1 opacity-75">({{ $questions->count() }})</span>
                                </span>
                            @endforeach
                        </div>

                        <div class="mt-auto pt-3 border-top">
                            <a href="{{ route('participant.quiz.result', $quiz->id) }}"
                                class="btn btn-primary w-100 d-flex justify-content-center align-items-center" style="border-radius: 10px;">
                                <i class="ti ti-report-analytics me-2"></i> Lihat Detail Riwayat Hasil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
