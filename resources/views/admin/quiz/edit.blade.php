@extends('layouts.admin_layout', ['title' => $title])
@section('content')
    @include('components.alert')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Quiz</h5>
            <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Pertanyaan</label>
                    <input type="text" name="question" class="form-control" value="{{ old('question', $quiz->question) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipe Quiz</label>
                    <select name="type" class="form-control" id="quizType" required>
                        <option value="multiple_choice" {{ $quiz->type == 'multiple_choice' ? 'selected' : '' }}>Pilihan
                            Ganda</option>
                        <option value="true_false" {{ $quiz->type == 'true_false' ? 'selected' : '' }}>Benar / Salah
                        </option>
                        <option value="fill_blank" {{ $quiz->type == 'fill_blank' ? 'selected' : '' }}>Isi Kosong</option>
                        <option value="matching" {{ $quiz->type == 'matching' ? 'selected' : '' }}>Menjodohkan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar (Opsional)</label>
                    <input type="file" name="image" class="form-control">
                    @if ($quiz->image)
                        <img src="{{ asset('uploads/' . $quiz->image) }}" class="mt-2" style="max-width: 150px;">
                    @endif
                </div>

                {{-- Pilihan Jawaban --}}
                <div class="mb-3" id="optionsWrapper"
                    style="{{ $quiz->type != 'multiple_choice' ? 'display:none' : '' }}">
                    <label class="form-label">Pilihan Jawaban</label>
                    <div id="optionList">
                        @foreach ($quiz->options as $i => $option)
                            <div class="d-flex mb-2 option-item">
                                <input type="text" name="options[{{ $i }}][text]" class="form-control me-2"
                                    value="{{ $option->option_text }}" required>
                                <div class="form-check me-2">
                                    <input class="form-check-input" type="checkbox"
                                        name="options[{{ $i }}][is_correct]"
                                        {{ $option->is_correct ? 'checked' : '' }}>
                                    <label class="form-check-label">Benar</label>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm removeOption">X</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="addOption" class="btn btn-success btn-sm mt-2">+ Tambah Pilihan</button>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let optionIndex = {{ count($quiz->options) }};

            document.getElementById('addOption').addEventListener('click', function() {
                const optionHtml = `
            <div class="d-flex mb-2 option-item">
                <input type="text" name="options[${optionIndex}][text]" class="form-control me-2" placeholder="Teks jawaban" required>
                <div class="form-check me-2">
                    <input class="form-check-input" type="checkbox" name="options[${optionIndex}][is_correct]">
                    <label class="form-check-label">Benar</label>
                </div>
                <button type="button" class="btn btn-danger btn-sm removeOption">X</button>
            </div>
        `;
                document.getElementById('optionList').insertAdjacentHTML('beforeend', optionHtml);
                optionIndex++;
            });

            document.getElementById('optionList').addEventListener('click', function(e) {
                if (e.target.classList.contains('removeOption')) {
                    e.target.closest('.option-item').remove();
                }
            });

            document.getElementById('quizType').addEventListener('change', function() {
                if (this.value !== 'multiple_choice') {
                    document.getElementById('optionsWrapper').style.display = 'none';
                } else {
                    document.getElementById('optionsWrapper').style.display = 'block';
                }
            });
        });
    </script>
@endsection
