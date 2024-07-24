@extends('layouts.admin_layout', ['title' => $title])
@section('content')
    @include('components.alert')

    <div class="card">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12 col-lg-5">
                    <h5 class="card-title fw-semibold mb-4">Data Anggota</h5>
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
                            <a href="{{ route('admin.members.create') }}" class="btn btn-primary py-2">
                                <i class="ti ti-plus"></i>
                                Tambah Anggota
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama lengkap</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Jenis kelamin</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @if ($members->isEmpty())
                        <tr>
                            <td class="text-center" colspan="7"><b>Tidak ada data</b></td>
                        </tr>
                    @else
                        @foreach ($members as $key => $member)
                            <tr>
                                <th scope="row">{{ $members->firstItem() + $key }}</th>
                                <td>
                                    <a href="#" class="text-primary-emphasis text-decoration-underline">
                                        <b>{{ $member->first_name . ' ' . $member->last_name }}</b>
                                    </a>
                                </td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->phone }}</td>
                                <td>{{ $member->address }}</td>
                                <td>{{ $member->gender }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.members.edit', $member->uuid) }}"
                                            class="btn btn-primary mb-2">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.members.destroy', $member->uuid) }}"
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

            <div class="d-flex justify-content-center">{{ $members->links() }}</div>
        </div>
    </div>
@endsection
