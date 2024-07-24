@extends('layouts.admin_layout', ['title' => $title])
@section('content')
    @include('components.alert')

    <div class="card">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12 col-lg-5">
                    <h5 class="card-title fw-semibold mb-4">Data {{ $title }}</h5>
                </div>

            </div>
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kategori</th>
                        <th scope="col" class="text-center">Jumlah buku</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @if ($categories->isEmpty())
                        <tr>
                            <td class="text-center" colspan="7"><b>Tidak ada data</b></td>
                        </tr>
                    @else
                        <form action="{{ route('admin.categories.store') }}" method="post">
                            @csrf
                            <tr class="">
                                <td></td>
                                <td>
                                    <input name="name" type="text" class="form-control" placeholder="Kategori">
                                </td>
                                <td align="center"> <button type="submit" class="btn btn-primary"> <i
                                            class="ti ti-plus"></i> Simpan</button></td>
                                <td colspan="2"></td>
                            </tr>
                        </form>
                        @foreach ($categories as $key => $kategori)
                            <tr>
                                <th scope="row">{{ $categories->firstItem() + $key }}</th>
                                <td>{{ $kategori->name }}</td>
                                <td align="center">{{ 20 }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="#" class="btn btn-primary mb-2" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $kategori->id }}">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $kategori->id) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Apakah yakin?');">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <div class="d-flex justify-content-center">{{ $categories->links() }}</div>
        </div>
    </div>
    @foreach ($categories as $key => $kategori)
        <form action="{{ route('admin.categories.update') }}" method="post">
            @csrf
            <x-modal title="Edit Kategori" idModal="edit{{ $kategori->id }}">
                <input type="hidden" name="id" value="{{ $kategori->id }}">
                <input type="text" name="name" value="{{ $kategori->name }}" class="form-control"
                    placeholder="Kategori">
            </x-modal>
        </form>
    @endforeach
@endsection
