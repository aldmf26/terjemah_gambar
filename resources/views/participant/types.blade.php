@extends('layouts.admin_layout', ['title' => 'Pilih Tipe Soal'])
@section('content')

<div class="container">
    <h3>Pilih Tipe Soal: {{ $quiz->title }}</h3>
    <div class="row row-cols-1 row-cols-md-2 g-4 mt-3 rounded-lg">
        @foreach($types as $type)
            <div class="col">
                <div class="card" style="border-radius: 0.5rem;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">{{ ucwords(str_replace('_',' ',$type)) }}</h5>
                            <p class="card-text">
                                Total Soal: {{ $quiz->questions()->where('question_type',$type)->count() }}
                            </p>

                            @if(in_array($type,$completedTypes))
                                <span class="badge bg-success">✔ Selesai</span>
                                @if(isset($attemptMap[$type]))
                                    <a href="{{ route('participant.quiz.result.detail', [$quiz->id, $type]) }}" 

                                       class="btn btn-sm btn-primary mt-1">
                                        Riwayat
                                    </a>
                                @endif
                            @else
                                <span class="badge bg-secondary">Belum Dikerjakan</span>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('participant.quiz.start', [$quiz->id, $type]) }}" 
                               class="btn btn-lg btn-primary">
                               Let's go!
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
