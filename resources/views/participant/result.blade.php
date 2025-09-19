@extends('layouts.admin_layout', ['title' => 'Hasil Quiz'])
@section('content')
    <div class="container">
        <h3>Hasil Quiz: {{ $attempt->quiz->title }}</h3>
        <h5 class="text-muted">Peserta: <b>{{ ucwords($attempt->user->name ?? 'Guest') }}</b></h5>

        <div class="card mb-4">
            <div class="card-body text-center">
                <h4>Total Skor</h4>
                <h2 class="mb-0">Nilai: <b>{{ number_format(($totalCorrect / max(1, $totalQuestions)) * 100, 0) }}%</b>
                </h2>
                <p class="fw-bold">Total Soal: {{ $totalCorrect }}/{{ $totalQuestions }}</p>
            </div>
        </div>

        <h5>Rincian Per Tipe Soal</h5>
        <div class="row">
            @foreach ($summary as $type => $data)
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <h6>{{ ucwords(str_replace('_', ' ', $type)) }}</h6>
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <td align="left">Total Soal</td>
                                        <td>:</td>
                                        <td class="text-end">{{ $data['total'] }}</td>
                                    </tr>
                                    <tr>
                                        <td align="left">Soal Benar</td>
                                        <td>:</td>
                                        <td class="text-end">{{ $data['correct'] }}</td>
                                    </tr>
                                    <tr>
                                        <td align="left">Nilai</td>
                                        <td>:</td>
                                        <td class="text-end">
                                            {{ $data['total'] > 0 ? number_format(($data['correct'] / $data['total']) * 100, 0) : 0 }}%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">Riwayat Jawaban</td>
                                        <td>:</td>
                                        <td class="text-end">
                                            <a href="{{ route('participant.quiz.result.detail', [$attempt->id, $type]) }}"
                                                class="btn btn-sm btn-primary">Lihat</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('participant.dashboard') }}" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
    </div>
@endsection
