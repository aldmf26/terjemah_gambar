@extends('layouts.admin_layout', ['title' => 'Dashboard'])
@section('content')
        <div class="alert alert-danger mb-4" role="alert">
            Anda belum menjawab soal, silakan <a href="{{ route('participant.dashboard') }}" class="btn btn-outline-warning">kembali ke halaman soal</a>
        </div>

@endsection
