@extends('layouts.admin_layout', ['title' => $title])

@section('content')
    <a href="{{ route('scramble-words.index') }}" class="btn btn-outline-primary mb-3">
        <i class="ti ti-arrow-left"></i> Kembali
    </a>

    @if (session('msg') || $errors->any())
        <div class="pb-2">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @if(session('msg'))
                    {{ session('msg') }}
                @else
                    Ada kesalahan pengisian form. Silakan cek kembali data Anda.
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <h4 class="card-title fw-bold text-primary mb-4">
                <i class="ti ti-plus me-2"></i>Tambah Kata Scramble Baru
            </h4>

            <form action="{{ route('scramble-words.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Preview Image -->
                    <div class="col-12 col-md-4 mb-4 text-center">
                        <div class="border rounded p-3 bg-light">
                            <label class="form-label d-block text-secondary fw-semibold">Preview Ilustrasi</label>
                            <img id="imagePreview" src="{{ asset('uploads/book_cover/default.jpg') }}" 
                                 class="img-fluid rounded border shadow-sm" style="max-height: 250px; object-fit: cover;" alt="Preview Ilustrasi">
                        </div>
                    </div>

                    <!-- Input Fields -->
                    <div class="col-12 col-md-8">
                        <div class="row">
                            <div class="col-12 col-md-12 mb-3">
                                <label for="question" class="form-label fw-semibold">Pertanyaan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('question') is-invalid @enderror" 
                                    id="question" name="question" placeholder="Contoh: gambut" value="{{ old('question') }}" required>
                                <div class="invalid-feedback">
                                    @error('question') {{ $message }} @enderror
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-6 mb-3">
                                <label for="original_word" class="form-label fw-semibold">Kata Asli <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('original_word') is-invalid @enderror" 
                                    id="original_word" name="original_word" placeholder="Contoh: gambut" value="{{ old('original_word') }}" required>
                                <div class="invalid-feedback">
                                    @error('original_word') {{ $message }} @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="scrambled_word" class="form-label fw-semibold">Kata Acak (Scrambled) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('scrambled_word') is-invalid @enderror" 
                                    id="scrambled_word" name="scrambled_word" placeholder="Contoh: tabmug" value="{{ old('scrambled_word') }}" required>
                                <div class="invalid-feedback">
                                    @error('scrambled_word') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="level_tier" class="form-label fw-semibold">Tingkatan Level <span class="text-danger">*</span></label>
                                <select class="form-select @error('level_tier') is-invalid @enderror" id="level_tier" name="level_tier" required>
                                    <option value="" disabled selected>Pilih Level</option>
                                    <option value="1" {{ old('level_tier') == 1 ? 'selected' : '' }}>1 - Beginner</option>
                                    <option value="2" {{ old('level_tier') == 2 ? 'selected' : '' }}>2 - Intermediate</option>
                                    <option value="3" {{ old('level_tier') == 3 ? 'selected' : '' }}>3 - Advanced</option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('level_tier') {{ $message }} @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="illustration_image" class="form-label fw-semibold">Gambar Ilustrasi</label>
                                <input type="file" class="form-control @error('illustration_image') is-invalid @enderror" 
                                    id="illustration_image" name="illustration_image" accept="image/*" onchange="previewFile(event)">
                                <div class="invalid-feedback">
                                    @error('illustration_image') {{ $message }} @enderror
                                </div>
                                <span class="text-muted small">Format: JPG, PNG, JPEG. Maksimal 2MB.</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="scientific_description" class="form-label fw-semibold">Deskripsi Ilmiah (Edukasi Pop-Up) <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('scientific_description') is-invalid @enderror" 
                                id="scientific_description" name="scientific_description" rows="5" 
                                placeholder="Masukkan penjelasan ilmiah mengenai kata ini ketika nanti berhasil ditebak user..." required>{{ old('scientific_description') }}</textarea>
                            <div class="invalid-feedback">
                                @error('scientific_description') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="ti ti-device-floppy me-1"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function previewFile(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
