@extends('layouts.admin_layout', ['title' => $title])

@section('content')
    @include('components.alert')

    @if ($errors->any())
        <div class="pb-2">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Ada beberapa kesalahan input. Silakan cek kembali data Anda.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <h4 class="card-title fw-bold text-primary mb-4">
                <i class="ti ti-settings me-2"></i>Pengaturan Global Word Scramble
            </h4>

            <form action="{{ route('scramble-settings.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Kolom Kiri: Gameplay parameters -->
                    <div class="col-12 col-md-6 mb-4 border-end-md">
                        <h5 class="fw-semibold text-secondary mb-3"><i class="ti ti-device-gamepad-2 me-1"></i>Gameplay & Aturan</h5>
                        
                        <div class="mb-3">
                            <label for="timer_duration" class="form-label fw-semibold">Durasi Timer Per Soal (Detik) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('timer_duration') is-invalid @enderror" 
                                id="timer_duration" name="timer_duration" min="10" value="{{ old('timer_duration', $settings->timer_duration) }}" required>
                            <div class="invalid-feedback">
                                @error('timer_duration') {{ $message }} @enderror
                            </div>
                            <span class="text-muted small">Waktu berpikir maksimal bagi user untuk menjawab (default: 60 detik).</span>
                        </div>

                        <div class="mb-3">
                            <label for="min_score_to_unlock_intermediate" class="form-label fw-semibold">Batas Skor Untuk Level Intermediate <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('min_score_to_unlock_intermediate') is-invalid @enderror" 
                                id="min_score_to_unlock_intermediate" name="min_score_to_unlock_intermediate" min="0" value="{{ old('min_score_to_unlock_intermediate', $settings->min_score_to_unlock_intermediate) }}" required>
                            <div class="invalid-feedback">
                                @error('min_score_to_unlock_intermediate') {{ $message }} @enderror
                            </div>
                            <span class="text-muted small">Skor total minimal yang harus dicapai peserta kuis untuk membuka Level 2.</span>
                        </div>

                        <div class="mb-3">
                            <label for="min_score_to_unlock_advanced" class="form-label fw-semibold">Batas Skor Untuk Level Advanced <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('min_score_to_unlock_advanced') is-invalid @enderror" 
                                id="min_score_to_unlock_advanced" name="min_score_to_unlock_advanced" min="0" value="{{ old('min_score_to_unlock_advanced', $settings->min_score_to_unlock_advanced) }}" required>
                            <div class="invalid-feedback">
                                @error('min_score_to_unlock_advanced') {{ $message }} @enderror
                            </div>
                            <span class="text-muted small">Skor total minimal yang harus dicapai peserta kuis untuk membuka Level 3.</span>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Visual & Audio assets -->
                    <div class="col-12 col-md-6 mb-4">
                        <h5 class="fw-semibold text-secondary mb-3"><i class="ti ti-photo-music me-1"></i>Aset Visual & Audio</h5>

                        <!-- Background Image -->
                        <div class="mb-4">
                            <label for="background_image" class="form-label fw-semibold">Gambar Background Lahan Basah (Wetland)</label>
                            <input type="file" class="form-control @error('background_image') is-invalid @enderror" 
                                id="background_image" name="background_image" accept="image/*" onchange="previewBg(event)">
                            <div class="invalid-feedback">
                                @error('background_image') {{ $message }} @enderror
                            </div>
                            <span class="text-muted small d-block mb-2">Unggah gambar baru untuk mengganti latar belakang permainan kuis scramble.</span>

                            <div class="border rounded p-2 text-center bg-light" style="max-height: 180px; overflow: hidden;">
                                <img id="bgPreview" src="{{ $settings->background_image ? asset($settings->background_image) : asset('assets/images/wetland/default_bg.jpg') }}" 
                                    class="img-fluid rounded border" style="max-height: 160px; object-fit: cover;" alt="Background Preview">
                            </div>
                        </div>

                        <!-- Background Music -->
                        <div class="mb-3">
                            <label for="background_music" class="form-label fw-semibold">Musik Latar Belakang (Audio MP3)</label>
                            <input type="file" class="form-control @error('background_music') is-invalid @enderror" 
                                id="background_music" name="background_music" accept="audio/mp3,audio/mpeg">
                            <div class="invalid-feedback">
                                @error('background_music') {{ $message }} @enderror
                            </div>
                            <span class="text-muted small d-block mb-2">Unggah file musik format MP3 yang akan diputar otomatis.</span>

                            @if($settings->background_music)
                                <div class="mt-2 p-2 bg-light border rounded d-flex align-items-center justify-content-between">
                                    <span class="small text-truncate text-secondary"><i class="ti ti-music me-1"></i>{{ basename($settings->background_music) }}</span>
                                    <audio controls class="mh-30" style="max-width: 200px;">
                                        <source src="{{ asset($settings->background_music) }}" type="audio/mpeg">
                                        Browser Anda tidak mendukung player audio.
                                    </audio>
                                </div>
                            @else
                                <span class="badge bg-light text-muted border py-2 px-3"><i class="ti ti-music-off me-1"></i>Belum ada musik diunggah</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="border-top pt-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2">
                        <i class="ti ti-device-floppy me-1"></i> Simpan Semua Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function previewBg(event) {
            const input = event.target;
            const preview = document.getElementById('bgPreview');
            
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
