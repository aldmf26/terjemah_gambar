@extends('layouts.admin_layout', ['title' => 'Dashboard'])
@section('content')
    <h3 class="mb-4">Dashboard Peserta</h3>

    <div class="row">
        @foreach ($quizzes as $quiz)
            <div class="col-md-6">
                <div class="card shadow-sm mb-3">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <h5>{{ $quiz->title }}</h5>
                            <ul class="list-unstyled">
                                <li><span class="badge bg-secondary mb-2">Tipe Soal:</span></li>
                                @foreach ($quiz->questions->groupBy('question_type')->sortBy(function ($item, $key) {
                                    $order = ['multiple_choice', 'true_false', 'fill_blank', 'matching'];
                                    return array_search($key, $order);
                                }) as $type => $questions)
                                    <li><span class="mb-1 badge bg-light text-dark">{{ ucwords(str_replace('_', ' ', $type)) }}
                                            ({{ $questions->count() }})
                                        </span></li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <a href="{{ route('participant.quiz.result', $quiz->id) }}"
                                class="btn btn-sm btn-primary">
                                Lihat Hasil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
