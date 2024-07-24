@extends('layouts.admin_layout', ['title' => $title])
@section('content')
    @include('components.alert')

    <div class="card">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12 col-lg-5">
                    <h5 class="card-title fw-semibold mb-4">Data Buku</h5>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <div>
                            <form action="" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" value="<?= $search ?? '' ?>"
                                        placeholder="Cari anggota" aria-label="Cari anggota"
                                        aria-describedby="searchButton">
                                    <button class="btn btn-outline-secondary" type="submit" id="searchButton">Cari</button>
                                </div>
                            </form>
                        </div>
                        <div>
                            <a href="{{ route('admin.books.create') }}" class="btn btn-primary py-2">
                                <i class="ti ti-plus"></i>
                                Tambah Buku
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Rak</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="table-group-divider">
                    @if ($books->isEmpty())
                        <tr>
                            <td class="text-center" colspan="7"><b>Tidak ada data</b></td>
                        </tr>
                    @else
                        @foreach ($books as $key => $book)
                            <tr>
                                <th scope="row">{{ $books->firstItem() + $key }}</th>
                                <td>
                                    <a href="{{ route('admin.books.show', $book->slug) }}">
                                        <div class="d-flex justify-content-center" style="max-width: 150px; height: 120px;">
                                           
                                            <img class="mx-auto mh-100"
                                                src="{{ asset('uploads/book_cover/' . $book->book_cover ?? 'default.jpg') }}"
                                                alt="{{ $book->title }}">
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.books.show', $book->slug) }}">
                                        <p class="text-primary-emphasis text-decoration-underline">
                                            <b>{{ $book->title . ' (' . $book->year . ')' }}</b>
                                        </p>
                                        <p class="text-body">Author: {{ $book->author }}</p>
                                    </a>
                                </td>
                                <td>{{ $book->category }}</td>
                                <td>{{ $book->rack }}</td>
                                <td>{{ $book->quantity }}</td>
                                <td>
                                    <a href="{{ route('admin.books.edit', $book->slug) }}"
                                        class="d-block btn btn-primary w-100 mb-2">
                                        <i class="ti ti-edit"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.books.destroy', $book->slug) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger w-100"
                                            onclick="return confirm('Are you sure?');">
                                            <i class="ti ti-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            
                        @endforeach
                    @endif
                </tbody>

            </table>

            <div class="d-flex justify-content-center">{{ $books->links() }}</div>
        </div>
    </div>
@endsection
