@extends('layouts.admin_layout', ['title' => 'Tambah Buku'])


@section('content')
    <a href="{{ route('admin.books.index') }}" class="btn btn-outline-primary mb-3">
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
            <h5 class="card-title fw-semibold">Form Tambah Buku</h5>
            <form action="{{ route('admin.books.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-3 p-3">
                        <div class="position-relative">
                            <img id="bookCoverPreview" src="{{ asset('uploads/book_cover/default.jpg') }}" alt="" height="300" class="img-fluid z-1">
                            <div class="position-absolute top-50 start-50 translate-middle z-0 d-none" id="imagePreviewContainer">
                                <img id="imagePreview" src="" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-8 col-xl-9">
                        <div class="mb-3">
                            <label for="cover" class="form-label">Gambar sampul buku</label>
                            <input class="form-control @error('cover') is-invalid @enderror" type="file" id="cover" name="cover" onchange="previewImage(event)">
                            <div class="invalid-feedback">
                                @error('cover')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul buku</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') ?? '' }}" required>
                            <div class="invalid-feedback">
                                @error('title')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Pengarang</label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author') ?? '' }}" required>
                            <div class="invalid-feedback">
                                @error('author')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="publisher" class="form-label">Penerbit</label>
                            <input type="text" class="form-control @error('publisher') is-invalid @enderror" id="publisher" name="publisher" value="{{ old('publisher') ?? '' }}" required>
                            <div class="invalid-feedback">
                                @error('publisher')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input minlength="10" maxlength="13" type="number" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" minlength="10" maxlength="13" aria-describedby="isbnHelp" value="{{ old('isbn') ?? '' }}" required>
                        <div id="isbnHelp" class="form-text">
                            ISBN must be 10-13 characters long, contain only numbers.
                        </div>
                        <div class="invalid-feedback">
                            @error('isbn')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="year" class="form-label">Tahun terbit</label>
                        <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" minlength="4" maxlength="4" value="{{ old('year') ?? '' }}" required>
                        <div class="invalid-feedback">
                            @error('year')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="rack" class="form-label">Rak</label>
                        <select class="form-select @error('rack') is-invalid @enderror" aria-label="Select rack" id="rack" name="rack" value="{{ old('rack') ?? '' }}" required>
                            <option>--Pilih rak--</option>
                            @foreach ($racks as $rack)
                                <option value="{{ $rack->id }}" >{{ $rack->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('rack')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select class="form-select @error('category') is-invalid @enderror" aria-label="Select category" id="category" name="category" value="{{ old('category') ?? '' }}" required>
                            <option>--Pilih category--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ (old('category') ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('category')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="stock" class="form-label">Jumlah stok buku</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') ?? '' }}" required>
                        <div class="invalid-feedback">
                            @error('stock')
                                {{ $message }}
                            @enderror
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
    const fileInput = document.querySelector('#cover');
    const imagePreview = document.querySelector('#bookCoverPreview');

    const reader = new FileReader();
    reader.readAsDataURL(fileInput.files[0]);

    reader.onload = function(e) {
      imagePreview.src = e.target.result;
    };
  }
</script>

@endsection

