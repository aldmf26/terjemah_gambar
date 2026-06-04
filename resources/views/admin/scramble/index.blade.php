@extends('layouts.admin_layout', ['title' => $title])

@section('content')
    @include('components.alert')

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <div class="row align-items-center mb-4">
                <div class="col-12 col-lg-6">
                    <h4 class="card-title fw-bold text-primary mb-1">
                        <i class="ti ti-forms me-2"></i>Kelola Kata Scramble
                    </h4>
                    <p class="text-muted mb-0 small">Tambahkan, edit, atau hapus kata-kata yang diacak beserta info ilmiahnya.</p>
                </div>
                <div class="col-12 col-lg-6 mt-3 mt-lg-0 text-lg-end">
                    <div class="d-flex gap-2 justify-content-lg-end align-items-center">
                        <form action="" method="get" class="mb-0 flex-grow-1 flex-lg-grow-0">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{ $search }}"
                                    placeholder="Cari Kata / Deskripsi..." aria-label="Cari kata scramble">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="ti ti-search"></i> Cari
                                </button>
                            </div>
                        </form>
                        <a href="{{ route('scramble-words.create') }}" class="btn btn-primary py-2 px-3">
                            <i class="ti ti-plus me-1"></i> Tambah Kata
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-secondary">
                        <tr>
                            <th scope="col" style="width: 60px;">No</th>
                            <th scope="col" style="width: 120px;">Ilustrasi</th>
                            <th scope="col">Kata Asli</th>
                            <th scope="col">Kata Acak</th>
                            <th scope="col">Level</th>
                            <th scope="col">Deskripsi Ilmiah</th>
                            <th scope="col" class="text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($words->isEmpty())
                            <tr>
                                <td class="text-center py-4" colspan="7">
                                    <div class="text-muted">
                                        <i class="ti ti-info-circle fs-7 d-block mb-2"></i>
                                        <b>Tidak ada data kata scramble ditemukan</b>
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach ($words as $key => $word)
                                <tr>
                                    <td>{{ $words->firstItem() + $key }}</td>
                                    <td>
                                        @if ($word->illustration_image)
                                            <img class="img-thumbnail" src="{{ asset($word->illustration_image) }}" alt="Ilustrasi" style="max-height: 80px; object-fit: cover;">
                                        @else
                                            <span class="badge bg-light text-muted border py-2 px-3">No Image</span>
                                        @endif
                                    </td>
                                    <td><strong class="text-success text-uppercase">{{ $word->original_word }}</strong></td>
                                    <td><span class="text-warning fw-semibold text-uppercase">{{ $word->scrambled_word }}</span></td>
                                    <td>
                                        @if ($word->level_tier == 1)
                                            <span class="badge bg-info">Beginner</span>
                                        @elseif($word->level_tier == 2)
                                            <span class="badge bg-warning text-dark">Intermediate</span>
                                        @else
                                            <span class="badge bg-danger">Advanced</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-wrap text-truncate" style="max-width: 300px;" title="{{ $word->scientific_description }}">
                                            {{ Str::limit($word->scientific_description, 100) }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('scramble-words.edit', $word->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="ti ti-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('scramble-words.destroy', $word->id) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kata ini?');">
                                                    <i class="ti ti-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="text-muted small">Menampilkan {{ $words->firstItem() ?? 0 }} - {{ $words->lastItem() ?? 0 }} dari {{ $words->total() }} data</span>
                <div>{{ $words->links() }}</div>
            </div>
        </div>
    </div>
@endsection
