@extends('layouts.admin_layout', ['title' => 'Dashboard'])
@section('content')

    <div class="container">
        <h3>Dashboard Admin</h3>
        <p class="text-muted">Selamat datang, {{ ucwords(Auth::user()->name) }}!</p>

    </div> 

@endsection
