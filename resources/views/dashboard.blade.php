@extends('layouts.admin_layout', ['title' => 'Dashboard Admin'])
@section('content')

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 text-white shadow-sm" style="border-radius: 15px; background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="me-4">
                        <div class="bg-white text-primary rounded-circle d-flex justify-content-center align-items-center shadow" style="width: 70px; height: 70px; font-size: 2rem;">
                            <i class="ti ti-user-shield"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-1 text-white">Selamat datang, {{ ucwords(Auth::user()->name) }}! 👋</h3>
                        <p class="mb-0 text-white-50">Ini adalah pusat kendali E-Terjemahan. Kelola kuis, pengguna, dan permainan dari sini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row mb-4">
        <!-- Stat Card 1 -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; border-left: 5px solid #4e73df;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-xs fw-bold text-primary text-uppercase mb-1" style="font-size: 0.8rem">Total Peserta</p>
                            <h3 class="mb-0 fw-bold text-dark">{{ $countUsers }}</h3>
                        </div>
                        <div class="text-gray-300">
                            <i class="ti ti-users fs-2 text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Stat Card 2 -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; border-left: 5px solid #1cc88a;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-xs fw-bold text-success text-uppercase mb-1" style="font-size: 0.8rem">Total Kuis</p>
                            <h3 class="mb-0 fw-bold text-dark">{{ $countQuizzes }}</h3>
                        </div>
                        <div class="text-gray-300">
                            <i class="ti ti-clipboard-list fs-2 text-success opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Stat Card 3 -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; border-left: 5px solid #36b9cc;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-xs fw-bold text-info text-uppercase mb-1" style="font-size: 0.8rem">Kata Scramble</p>
                            <h3 class="mb-0 fw-bold text-dark">{{ $countScrambleWords }}</h3>
                        </div>
                        <div class="text-gray-300">
                            <i class="ti ti-device-gamepad-2 fs-2 text-info opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Stat Card 4 -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; border-left: 5px solid #f6c23e;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-xs fw-bold text-warning text-uppercase mb-1" style="font-size: 0.8rem">Data Terjemahan</p>
                            <h3 class="mb-0 fw-bold text-dark">{{ $countTerjemah }}</h3>
                        </div>
                        <div class="text-gray-300">
                            <i class="ti ti-book fs-2 text-warning opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Row -->
    <div class="row">
        <!-- Aktivitas Kuis -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between" style="border-bottom: 1px solid #f8f9fc;">
                    <h6 class="m-0 fw-bold text-primary"><i class="ti ti-activity me-1"></i>Aktivitas Kuis Terbaru</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-muted small">
                                <tr>
                                    <th class="ps-3">Peserta</th>
                                    <th>Kuis</th>
                                    <th>Skor</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentQuizAttempts as $qa)
                                <tr>
                                    <td class="ps-3 fw-bold">{{ $qa->user->name ?? 'User Hapus' }}</td>
                                    <td>{{ $qa->quiz->title ?? 'Kuis Hapus' }}</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">{{ $qa->score }} Poin</span></td>
                                    <td><small class="text-muted">{{ $qa->completed_at ? \Carbon\Carbon::parse($qa->completed_at)->diffForHumans() : '-' }}</small></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Belum ada aktivitas kuis.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktivitas Scramble -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px;">
                <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between" style="border-bottom: 1px solid #f8f9fc;">
                    <h6 class="m-0 fw-bold text-info"><i class="ti ti-device-gamepad-2 me-1"></i>Aktivitas Word Scramble Terbaru</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-muted small">
                                <tr>
                                    <th class="ps-3">Peserta</th>
                                    <th>Mode Game</th>
                                    <th>Status</th>
                                    <th>Total Skor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentScrambleAttempts as $sa)
                                <tr>
                                    <td class="ps-3 fw-bold">{{ $sa->user->name ?? 'User Hapus' }}</td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ ucwords(str_replace('_', ' ', $sa->game_mode ?? 'Solo')) }}</span></td>
                                    <td>
                                        @if($sa->status == 'completed' || $sa->status == 'win')
                                            <span class="badge bg-success bg-opacity-10 text-success"><i class="ti ti-check"></i> Selesai</span>
                                        @elseif($sa->status == 'failed' || $sa->status == 'lose')
                                            <span class="badge bg-danger bg-opacity-10 text-danger"><i class="ti ti-x"></i> Gagal</span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning"><i class="ti ti-clock"></i> {{ ucfirst($sa->status ?? 'Bermain') }}</span>
                                        @endif
                                    </td>
                                    <td><span class="text-success fw-bold">+{{ $sa->score }}</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Belum ada aktivitas scramble.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
