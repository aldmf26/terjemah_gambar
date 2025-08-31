@extends('layouts.admin_layout', ['title' => $title])
@section('content')
    @include('components.alert')

    <div class="card">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-4">
                    <h5 class="card-title fw-semibold mb-4">Data {{ $title }}</h5>
                </div>
                <div class="col-8">
                    <div class="d-flex justify-content-end gap-2">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="<?= $search ?? '' ?>"
                                    placeholder="Cari Quiz" aria-label="Cari Quiz">
                                <button class="btn btn-outline-secondary" type="submit" id="searchButton">Cari</button>
                            </div>
                        </form>
                        <a href="{{ route('quizzes.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus"></i> Tambah Quiz
                        </a>
                    </div>
                </div>
            </div>

            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quizzes as $key => $quiz)
                        <tr>
                            <td>{{ $quizzes->firstItem() + $key }}</td>
                            <td>{{ $quiz->title }}</td>
                            <td>
                                {{-- <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-sm btn-primary">Edit</a> --}}
                                <a href="{{ route('quiz.questions.index', $quiz->id) }}"
                                    class="btn btn-sm btn-primary">Kelola Pertanyaan</a>
                                <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="post" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin hapus?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $quizzes->links() }}</div>
        </div>
    </div>
@endsection
