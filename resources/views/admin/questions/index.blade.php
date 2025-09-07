@extends('layouts.admin_layout', ['title' => 'Pertanyaan'])
@section('content')
    <div class="card">
        <div class="card-body">
            <x-alert />

            <h5 class="card-title">Pertanyaan untuk Quiz: {{ $quiz->title }}</h5>
            <div class="d-flex justify-content-between gap-2">
                <a href="{{ route('quiz.questions.create', $quiz->id) }}" class="btn btn-primary mb-3">+ Tambah Pertanyaan</a>
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" value="<?= $search ?? '' ?>"
                            placeholder="Cari Quiz" aria-label="Cari Quiz">
                        <button class="btn btn-outline-secondary" type="submit" id="searchButton">Cari</button>
                    </div>
                </form>
            </div>

            <nav>
                @php
                    $tipes = ['multiple_choice', 'true_false', 'fill_blank', 'matching'];
                @endphp
                
                <div class="nav nav-tabs" id="question-type-tab" role="tablist">
                    @foreach ($tipes as $t)
                    <a href="{{ route('quiz.questions.index', [$quiz->id, 'tipe' => $t]) }}" class="nav-link {{ $tipe == null || $tipe == $t ? 'active' : '' }}" >{{ ucwords(str_replace('_', ' ', $t)) }} <span class="ms-1 badge bg-secondary">{{ $quiz->questions()->where('question_type', $t)->count() }}</span></a>
                    @endforeach
                </div>
            </nav>
            

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

                            <td>
                                @if (stripos($question->question_text, 'jpg') !== false ||
                                        stripos($question->question_text, 'jpeg') !== false ||
                                        stripos($question->question_text, 'png') !== false ||
                                        stripos($question->question_text, 'webp') !== false)
                                        
                                    <div class="d-flex justify-content-center" style="max-width: 150px; height: 120px;">
                                        <img class="mx-auto mh-100"
                                            src="{{ asset('/uploads/questions/' . $question->question_text) }}">
                                    </div>
                                @else
                                    {{ $question->question_text }}
                                @endif
                            </td>
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
                                    method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin hapus pertanyaan ini?')">
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
