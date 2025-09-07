@extends('layouts.admin_layout', ['title' => 'Dashboard'])
@section('content')

    @role('user')
        <!-- Statistik -->
        <div class="row mb-4">
            <div class="col-lg-4 col-sm-6">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h2><i class="ti ti-clipboard-list"></i></h2>
                        <h4>{{ rand(10, 100) }} Quiz Tersedia</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h2><i class="ti ti-check"></i></h2>
                        <h4>{{ rand(5, 50) }} Quiz Selesai</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h2><i class="ti ti-award"></i></h2>
                        <h4>Skor Tertinggi: {{ rand(50, 1000) }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Ranking Top 10 -->
                <div class="card mb-4 shadow">
                    <div class="card-header">
                        <h5>🏆 Top 10 Peringkat</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead class="bg-success">
                                <tr>
                                    <th scope="col" class="text-center">Rank</th>
                                    <th scope="col">Peserta</th>
                                    <th scope="col" class="text-center">Skor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (range(1, 10) as $index)
                                    <tr>
                                        <td class="text-center">
                                            @if ($index == 1)
                                                <img src="https://img.icons8.com/?size=100&id=X6CJMckcVrBj&format=png&color=000000"
                                                    width="50" alt="Piala Emas">
                                            @elseif ($index == 2)
                                                <img src="https://img.icons8.com/?size=100&id=dgAxfaiZaNr6&format=png&color=000000"
                                                    width="50" alt="Piala Perak">
                                            @elseif ($index == 3)
                                                <img src="https://img.icons8.com/?size=100&id=lMwvkoCmvpSJ&format=png&color=000000"
                                                    width="50" alt="Piala Perunggu">
                                            @else
                                                <img src="https://img.icons8.com/color/48/{{ $index }}.png"
                                                    width="50" alt="Piala Perunggu">
                                            @endif
                                        </td>
                                        <td>User {{ $index }}</td>
                                        <td class="text-center">{{ number_format(rand(50, 1000), 0) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endrole

@endsection
