@extends('layouts.admin_layout', ['title' => $title])
@section('content')
@include('components.alert')

<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Quiz</h5>
        <form action="{{ route('quizzes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="question" class="form-control" value="{{ old('question') }}" required>
            </div>
            
            {{-- <div class="mb-3">
                <label class="form-label">Tipe Quiz</label>
                <select name="type" class="form-control" id="quizType" required>
                    <option value="multiple_choice">Pilihan Ganda</option>
                    <option value="true_false">Benar / Salah</option>
                    <option value="fill_blank">Isi Kosong</option>
                    <option value="matching">Menjodohkan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar (Opsional)</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3" id="optionsWrapper">
                <label class="form-label">Pilihan Jawaban</label>
                <div id="optionList">
                    <div class="d-flex mb-2 option-item">
                        <input type="text" name="options[0][text]" class="form-control me-2" placeholder="Teks jawaban" required>
                        <div class="form-check me-2">
                            <input class="form-check-input" type="checkbox" name="options[0][is_correct]">
                            <label class="form-check-label">Benar</label>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm removeOption">X</button>
                    </div>
                </div>
                <button type="button" id="addOption" class="btn btn-success btn-sm mt-2">+ Tambah Pilihan</button>
            </div> --}}

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let optionIndex = 1;

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
