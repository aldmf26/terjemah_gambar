@extends('layouts.admin_layout', ['title' => 'Word Scramble'])

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <h3 class="fw-bold mb-1"><i class="ti ti-device-gamepad-2 me-1"></i>Game Word Scramble</h3>
            <p class="text-muted small">Uji pemahaman kosakata lahan basah Anda dengan menyusun huruf-huruf acak.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @livewire('scramble-play')
        </div>
    </div>
@endsection
