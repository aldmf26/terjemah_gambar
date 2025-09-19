@extends('layouts.admin_layout', ['title' => 'Dashboard'])
@section('content')

@role('user')
    <!-- Statistik -->
    <div class="row mb-4">
    <div class="col-lg-4 col-sm-6">
        <div class="card text-center shadow">
            <div class="card-body">
                <h2><i class="ti ti-clipboard-list"></i></h2>
                <h4>{{ $totalQuiz }} Quiz Tersedia</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="card text-center shadow">
            <div class="card-body">
                <h2><i class="ti ti-check"></i></h2>
                <h4>{{ $quizSelesai }} Quiz Selesai</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="card text-center rounded-3 shadow">
            <div class="card-body">
                <h2><i class="ti ti-award"></i></h2>
                <h4>Total Poin: {{ number_format($totalPoin,0,'.') }}</h4>
                <small class="text-muted">Poin dihitung berdasarkan skor setiap quiz, 1 skor = 10 poin</small>
            </div>
        </div>
    </div>
</div>


    <!-- Ranking -->
 <div class="card mb-4 shadow">
    <div class="card-header">
        <h5>🏆 Top 10 Peringkat</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered " style="border-radius: 10px 10px 0 0;"> 
            <thead class="table-light">
                <tr>
                    <th class="text-center">Rank</th>
                    <th>Peserta</th>
                    <th class="text-center">Total Poin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ranking as $index => $row)
                    <tr class="{{ $row->name == auth()->user()->name ? 'table-active' : '' }}">
                        <td class="text-center" style="width: 80px; font-size:2rem">
                            @if ($index == 0)
                                🥇
                            @elseif ($index == 1)
                                🥈
                            @elseif ($index == 2)
                                🥉
                            @else
                                {{ $index+1 }}
                            @endif
                        </td>
                        <td class="align-middle">{{ $row->name }}  </td>
                        <td style="font-size:1.5rem" class="text-center align-middle">{{ number_format($row->total_poin,0,'.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endrole

@endsection
