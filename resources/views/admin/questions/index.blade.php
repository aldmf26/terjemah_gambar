@extends('layouts.admin_layout', ['title' => 'Pertanyaan'])
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pertanyaan untuk Quiz: {{ $quiz->title }}</h5>
            <a href="{{ route('quiz.questions.create', $quiz->id) }}" class="btn btn-primary mb-3">+ Tambah Pertanyaan</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Tipe</th>
                        <th>Opsi Jawaban</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($questions as $index => $question)
                        <tr>
                            <td>{{ $questions->firstItem() + $index }}</td>
                            <td>{{ $question->question_text }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $question->question_type)) }}</td>
                            <td>
                                @foreach ($question->options as $option)
                                    <div>{{ $option->option_text }} @if ($option->is_correct)
                                            <strong>(Benar)</strong>
                                        @endif
                                    </div>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('quiz.questions.edit', [$quiz->id, $question->id]) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('quiz.questions.destroy', [$quiz->id, $question->id]) }}"
                                    method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus pertanyaan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada pertanyaan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $questions->links() }}
        </div>
    </div>
@endsection
