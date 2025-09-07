@extends('layouts.admin_layout', ['title' => 'Pilih Tipe Soal'])
@section('content')

    <div class="container">
    <h3>Pilih Tipe Soal: {{ $quiz->title }}</h3>
    <div class="row row-cols-1 row-cols-md-2 g-4 mt-3 rounded-lg">
        @foreach($types as $type)
            <div class="col">
                <a href="{{ route('participant.quiz.start', [$quiz->id, $type]) }}" class="card text-decoration-none" style="border-radius: 0.5rem;">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">{{ ucwords(str_replace('_', ' ', $type)) }}</h5>
                            <p class="card-text">Total Soal: {{ $quiz->questions()->where('question_type', $type)->count() }}</p>
                        </div>
                        <div>
                        <p class="card-text btn btn-lg btn-primary">Let's go!</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
