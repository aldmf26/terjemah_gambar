@extends('layouts.admin_layout', ['title' => 'Pilih Tipe Soal'])
@section('content')
    <div class="container">
        @livewire('quizplay', ['quizId' => $quiz->id, 'type' => $type, 'attemptId' => $attemptId])
    </div>
@endsection
