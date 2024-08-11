@extends('layouts.admin_layout', ['title' => 'Edit Terjemahan'])


@section('content')
    <a href="{{ route('admin.terjemahan.index') }}" class="btn btn-outline-primary mb-3">
        <i class="ti ti-arrow-left"></i>
        Kembali
    </a>

    @if (session('msg'))
        <div class="pb-2">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold">Form Edit Terjemahan</h5>
            @php
                $imageBy = strpos($terjemahan->image, 'http') !== false ? 'url' : 'upload';
            @endphp
            <form action="{{ route('admin.terjemahan.update', $terjemahan->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row" x-data="{
                    imageBy: '{{$imageBy}}',
                }">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-3 p-3">
                        <div class="position-relative" x-show="imageBy === 'upload'">
                            <img id="bookCoverPreview" src="{{ $imageBy == 'url' ? $terjemahan->image : asset('/uploads/' . $terjemahan->image) }}" alt=""
                                height="300" class="img-fluid z-1">
                            <div class="position-absolute top-50 start-50 translate-middle z-0 d-none"
                                id="imagePreviewContainer">
                                <img id="imagePreview" src="" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <span x-text="imageBy"></span>
                    <div class="col-12 col-md-6">
                        <input @change="imageBy = 'upload'" type="radio" class="btn-check" name="options-outlined" id="success-outlined"
                            autocomplete="off" checked="">
                        <label class="btn btn-outline-success" for="success-outlined">By Upload</label>

                        <input @change="imageBy = 'url'" type="radio" class="btn-check" name="options-outlined" id="danger-outlined"
                            autocomplete="off">
                        <label class="btn btn-outline-danger" for="danger-outlined">By Url</label>

                        <div class="mb-3 mt-1">
                            <label for="image" class="form-label">Gambar</label>
                            <input value="{{ $terjemahan->image }}" class="form-control @error('image') is-invalid @enderror" :type="imageBy === 'upload' ? 'file' : 'text'" id="image"
                                name="image" onchange="previewImage(event)">
                            <div class="invalid-feedback">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ind" class="form-label">Indonesia</label>
                            <input value="{{ $terjemahan->ind }}" placeholder="input kata tanpa spasi" @input="$event.target.value = $event.target.value.replace(/\s/g, '')" type="text" class="form-control @error('ind') is-invalid @enderror" id="ind"
                                name="ind" value="{{ old('ind') ?? '' }}" required>
                            <div class="invalid-feedback">
                                @error('ind')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="en" class="form-label">Inggris</label>
                            <input value="{{ $terjemahan->en }}" placeholder="input kata tanpa spasi" @input="$event.target.value = $event.target.value.replace(/\s/g, '')" type="text" class="form-control @error('en') is-invalid @enderror" id="en"
                                name="en" value="{{ old('en') ?? '' }}" required>
                            <div class="invalid-feedback">
                                @error('en')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function previewImage() {
            const fileInput = document.querySelector('#image');
            const imagePreview = document.querySelector('#bookCoverPreview');

            const reader = new FileReader();
            reader.readAsDataURL(fileInput.files[0]);

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
        }
    </script>
@endsection
