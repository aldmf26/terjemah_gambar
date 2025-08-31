@extends('layouts.admin_layout', ['title' => 'Tambah Pertanyaan'])
@section('content')
    <div class="card">
        <div class="card-body">
            <x-alert />
            <h5 class="card-title">Tambah Pertanyaan untuk Quiz: {{ $quiz->title }}</h5>
            <form method="POST" action="{{ route('quiz.questions.store', $quiz->id) }}">
                @csrf
                <div class="mb-3">
                    <label>Pertanyaan</label>
                    <input type="text" name="question_text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Tipe Pertanyaan</label>
                    <select name="question_type" id="question_type" class="form-control">
                        <option value="multiple_choice">Pilihan Ganda</option>
                        <option value="true_false">Benar / Salah</option>
                        <option value="fill_blank">Isi Kosong</option>
                        <option value="matching">Mencocokkan (Matching)</option>
                    </select>
                </div>

                {{-- Container dinamis --}}
                <div id="options-container" class="mb-3">
                    {{-- Default untuk multiple choice --}}
                    <label>Opsi Jawaban</label>
                    <div class="option-item mb-2">
                        <input type="text" name="options[0][text]" class="form-control mb-1" placeholder="Jawaban">
                        <label><input type="checkbox" name="options[0][is_correct]"> Benar</label>
                        <button type="button" class="mb-2 btn btn-sm btn-danger float-end remove-option">X</button>
                    </div>
                    <button type="button" id="add-option" class="btn btn-sm btn-secondary mt-2">+ Tambah Opsi</button>
                </div>

                {{-- Untuk isi kosong (fill blank) --}}
                <div id="fill-blank-container" class="mb-3" style="display:none;">
                    <label>Jawaban Benar</label>
                    <input type="text" name="correct_answer" class="form-control">
                </div>

                <div id="matching-container" class="mb-3" style="display:none;">
                    <label>Jawaban Benar</label>
                    <input type="text" name="correct_answer" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        let questionType = document.getElementById('question_type');
        let optionsContainer = document.getElementById('options-container');
        let fillBlankContainer = document.getElementById('fill-blank-container');
        let matchingContainer = document.getElementById('matching-container');
        let addOptionBtn = document.getElementById('add-option');
        let addPairBtn = document.getElementById('add-pair');

        questionType.addEventListener('change', function() {
            if (this.value === 'multiple_choice') {
                optionsContainer.style.display = 'block';
                fillBlankContainer.style.display = 'none';
                matchingContainer.style.display = 'none';
                resetOptions();
            } else if (this.value === 'true_false') {
                optionsContainer.style.display = 'block';
                fillBlankContainer.style.display = 'none';
                matchingContainer.style.display = 'none';
                optionsContainer.innerHTML = `
            <label>Opsi Jawaban</label>
            <div class="option-item mb-2">
                <label><input type="radio" name="correct_option" value="True"> Benar / True</label>
            </div>
            <div class="option-item mb-2">
                <label><input type="radio" name="correct_option" value="False"> Salah / False</label>
            </div>
        `;
            } else if (this.value === 'fill_blank') {
                optionsContainer.style.display = 'none';
                fillBlankContainer.style.display = 'block';
                matchingContainer.style.display = 'none';
            } else if (this.value === 'matching') {
                optionsContainer.style.display = 'none';
                fillBlankContainer.style.display = 'none';
                matchingContainer.style.display = 'block';
            }
        });

        function resetOptions() {
            optionsContainer.innerHTML = `
        <label>Opsi Jawaban</label>
        <div class="option-item mb-2">
            <input type="text" name="options[0][text]" class="form-control mb-1" placeholder="Jawaban">
            <label><input type="checkbox" name="options[0][is_correct]"> Benar</label>
            <button type="button" class="mb-2 btn btn-sm btn-danger float-end remove-option">X</button>
        </div>
        <button type="button" id="add-option" class="btn btn-sm btn-secondary mt-2">+ Tambah Opsi</button>
    `;
        }

        // Add option for multiple choice
        optionsContainer.addEventListener('click', function(e) {
            if (e.target.id === 'add-option') {
                let index = optionsContainer.querySelectorAll('.option-item').length;
                let div = document.createElement('div');
                div.classList.add('option-item', 'mb-2');
                div.innerHTML = `
            <input type="text" name="options[${index}][text]" class="form-control mb-1" placeholder="Jawaban">
            <label><input type="checkbox" name="options[${index}][is_correct]"> Benar</label>
            <button type="button" class="btn btn-sm btn-danger mb-2 float-end remove-option">X</button>
        `;
                optionsContainer.insertBefore(div, e.target);
            }
            if (e.target.classList.contains('remove-option')) {
                e.target.closest('.option-item').remove();
            }
        });

        // Add pair for matching
        matchingContainer.addEventListener('click', function(e) {
            if (e.target.id === 'add-pair') {
                let index = matchingContainer.querySelectorAll('.matching-item').length;
                let div = document.createElement('div');
                div.classList.add('matching-item', 'mb-2');
                div.innerHTML = `
            <input type="text" name="pairs[${index}][left]" class="form-control mb-1"
                placeholder="Kiri (contoh: Ibu kota Indonesia)">
            <input type="text" name="pairs[${index}][right]" class="form-control mb-1"
                placeholder="Kanan (contoh: Jakarta)">
            <button type="button" class="btn btn-sm btn-danger float-end remove-pair">X</button>
        `;
                matchingContainer.insertBefore(div, e.target);
            }
            if (e.target.classList.contains('remove-pair')) {
                e.target.closest('.matching-item').remove();
            }
        });

        
    </script>
@endsection

