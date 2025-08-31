@extends('layouts.admin_layout', ['title' => 'Edit Pertanyaan'])
@section('content')
    <div class="card">
        <div class="card-body">
            <x-alert />
            <h5 class="card-title">Edit Pertanyaan untuk Quiz: {{ $quiz->title }}</h5>
            <form method="POST" action="{{ route('quiz.questions.update', [$quiz->id, $question->id]) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Pertanyaan</label>
                    <input type="text" name="question_text" class="form-control" value="{{ $question->question_text }}"
                        required>
                </div>
                <div class="mb-3">
                    <label>Tipe Pertanyaan</label>
                    <input type="hidden" name="question_type" value="{{ $question->question_type }}">
                    <select disabled name="question_type" id="question_type" class="form-control">
                        <option value="multiple_choice"
                            {{ $question->question_type == 'multiple_choice' ? 'selected' : '' }}>Pilihan Ganda</option>
                        <option value="true_false" {{ $question->question_type == 'true_false' ? 'selected' : '' }}>Benar /
                            Salah</option>
                        <option value="fill_blank" {{ $question->question_type == 'fill_blank' ? 'selected' : '' }}>Isi
                            Kosong</option>
                        <option value="matching" {{ $question->question_type == 'matching' ? 'selected' : '' }}>Mencocokkan
                            (Matching)</option>
                    </select>
                </div>

                {{-- Multiple choice --}}
                <div id="options-container" class="mb-3"
                    style="{{ $question->question_type == 'multiple_choice' ? 'display:block;' : 'display:none;' }}">
                    <label>Opsi Jawaban</label>
                    @foreach ($question->options as $i => $option)
                        <div class="option-item mb-2">
                            <input type="text" name="options[{{ $i }}][text]"
                                value="{{ $option->option_text }}" class="form-control mb-1" placeholder="Jawaban">
                            <label><input type="checkbox" name="options[{{ $i }}][is_correct]"
                                    {{ $option->is_correct ? 'checked' : '' }}> Benar</label>
                            <button type="button" class="btn btn-sm btn-danger mb-2 float-end remove-option">X</button>
                        </div>
                    @endforeach
                    <button type="button" id="add-option" class="btn btn-sm btn-secondary mt-2">+ Tambah Opsi</button>
                </div>

                {{-- True/False --}}
                <div id="true-false-container" class="mb-3"
                    style="{{ $question->question_type == 'true_false' ? 'display:block;' : 'display:none;' }}">
                    <label>Jawaban Benar</label>
                    <div class="option-item mb-2">
                        <label><input type="radio" name="correct_option" value="True"
                                {{ $question->options->where('option_text', 'True')->first()?->is_correct ?? false ? 'checked' : '' }}>
                            Benar / True</label>
                    </div>
                    <div class="option-item mb-2">
                        <label><input type="radio" name="correct_option" value="False"
                                {{ $question->options->where('option_text', 'False')->first()?->is_correct ?? false ? 'checked' : '' }}>
                            Salah / False</label>
                    </div>
                </div>

                {{-- Fill blank --}}
                <div id="fill-blank-container" class="mb-3"
                    style="{{ $question->question_type == 'fill_blank' || $question->question_type == 'matching' ? 'display:block;' : 'display:none;' }}">
                    <label>Jawaban Benar</label>
                    <input type="text" name="correct_answer" class="form-control"
                        value="{{ $question->options->first()?->option_text }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

    <script>
        // Sama persis dengan script di create
    </script>
@endsection
