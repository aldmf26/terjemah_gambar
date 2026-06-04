@extends('layouts.admin_layout', ['title' => 'Dashboard'])
@section('content')

    @role('user')
        <!-- Welcome Banner -->
        <div class="card shadow-sm border-0 mb-4 bg-primary text-white" style="border-radius: 16px;">
            <div class="card-body p-4 p-md-5 d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="fw-bolder mb-2 text-white">Halo, {{ auth()->user()->name }}! 👋</h2>
                    @php
    $motivasiText = 'Semangat terus dalam belajar!'; // default jika gagal load

    if (Storage::exists('motivasi.json')) {
        $motivasiArray = json_decode(Storage::get('motivasi.json'), true);

        if (is_array($motivasiArray) && count($motivasiArray) > 0) {
            // Ambil satu motivasi secara acak
            $motivasiText = $motivasiArray[array_rand($motivasiArray)];
        }
    }
@endphp

<p class="fs-5 mb-0 opacity-75"><em>"{{ $motivasiText }}"</em></p>
                </div>
                <div class="d-none d-md-block">
                    <i class="ti ti-rocket" style="font-size: 6rem; opacity: 0.2;"></i>
                </div>
            </div>
        </div>

        <!-- Quiz Stats Card -->
        <div class="card shadow-sm border-0 mb-4" style="border-radius: 16px;">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center me-3"
                        style="width: 60px; height: 60px;">
                        <i class="ti ti-clipboard-list fs-1"></i>
                    </div>
                    <h3 class="fw-bold mb-0 text-dark">Statistik Kuis</h3>
                </div>
                <div class="row text-center">
                    <div class="col-4 border-end">
                        <h1 class="fw-bolder text-primary mb-1" style="font-size: 3.5rem;">{{ $totalQuiz }}</h1>
                        <span class="text-muted fs-5">Kuis Tersedia</span>
                    </div>
                    <div class="col-4 border-end">
                        <h1 class="fw-bolder text-success mb-1" style="font-size: 3.5rem;">{{ $quizSelesai }}</h1>
                        <span class="text-muted fs-5">Diselesaikan</span>
                    </div>
                    <div class="col-4">
                        <h1 class="fw-bolder text-warning mb-1" style="font-size: 3.5rem;">{{ $totalPoin }}</h1>
                        <span class="text-muted fs-5">Total Poin</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scramble Stats Card -->
        <div class="card shadow-sm border-0 mb-4" style="border-radius: 16px;">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex justify-content-center align-items-center me-3"
                        style="width: 60px; height: 60px;">
                        <i class="ti ti-device-gamepad-2 fs-1"></i>
                    </div>
                    <h3 class="fw-bold mb-0 text-dark">Statistik Word Scramble</h3>
                </div>
                <div class="row text-center">
                    <div class="col-6 border-end">
                        <h1 class="fw-bolder text-info mb-1" style="font-size: 3.5rem;">{{ $scrambleMain }}</h1>
                        <span class="text-muted fs-5">Bermain Scramble</span>
                    </div>
                    <div class="col-6">
                        <h1 class="fw-bolder text-danger mb-1" style="font-size: 3.5rem;">{{ $scramblePoin }}</h1>
                        <span class="text-muted fs-5">Poin Scramble</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top 10 Leaderboard -->
        <div class="card shadow-sm border-0 mb-4" style="border-radius: 16px; overflow: hidden;">
            <div class="card-header bg-white border-bottom p-4">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex justify-content-center align-items-center me-3"
                        style="width: 50px; height: 50px;">
                        <i class="ti ti-trophy fs-2"></i>
                    </div>
                    <h4 class="fw-bold mb-0 text-dark">Top 10 Leaderboard</h4>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless mb-0 align-middle">
                        <thead class="table-light text-muted">
                            <tr>
                                <th class="text-center py-3 fs-6" style="width: 80px;">Rank</th>
                                <th class="py-3 fs-6">Peserta</th>
                                <th class="text-center py-3 fs-6">Poin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ranking as $index => $row)
                                <tr class="{{ $row->name == auth()->user()->name ? 'bg-primary bg-opacity-10' : '' }}"
                                    style="border-bottom: 1px solid #f8f9fa;">
                                    <td class="text-center py-3">
                                        @if ($index == 0)
                                            <span style="font-size: 2rem;" title="Peringkat 1">🥇</span>
                                        @elseif ($index == 1)
                                            <span style="font-size: 2rem;" title="Peringkat 2">🥈</span>
                                        @elseif ($index == 2)
                                            <span style="font-size: 2rem;" title="Peringkat 3">🥉</span>
                                        @else
                                            <span
                                                class="badge bg-light text-dark border fs-5 rounded-circle d-inline-flex justify-content-center align-items-center"
                                                style="width: 40px; height: 40px;">{{ $index + 1 }}</span>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-dark text-white rounded-circle d-flex justify-content-center align-items-center me-3"
                                                style="width: 50px; height: 50px; font-weight: bold; font-size: 1.4rem;">
                                                {{ strtoupper(substr($row->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <h5
                                                    class="mb-0 fw-bold {{ $row->name == auth()->user()->name ? 'text-primary' : 'text-dark' }}">
                                                    {{ $row->name }}</h5>
                                                @if ($row->name == auth()->user()->name)
                                                    <span class="badge bg-primary text-white mt-1 fs-6">Ini Anda</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center py-3">
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 fs-5"
                                            style="border-radius: 8px;">
                                            <i class="ti ti-star-filled text-warning"></i>
                                            {{ number_format($row->total_poin, 0, '.') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted fs-5">
                                        Belum ada data ranking.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endrole

@endsection
