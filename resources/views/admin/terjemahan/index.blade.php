@extends('layouts.admin_layout', ['title' => $title])
@section('content')
    @include('components.alert')

    <div class="card">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12 col-lg-5">
                    <h5 class="card-title fw-semibold mb-4">Data {{ $title }}</h5>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <div>
                            <form action="" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" value="<?= $search ?? '' ?>"
                                        placeholder="Cari anggota" aria-label="Cari Terjemahan"
                                        aria-describedby="searchButton">
                                    <button class="btn btn-outline-secondary" type="submit" id="searchButton">Cari</button>
                                </div>
                            </form>
                        </div>
                        <div>
                            @role(['admin', 'superadmin'])
                            <a href="{{ route('admin.terjemahan.create') }}" class="btn btn-primary py-2">
                                <i class="ti ti-plus"></i>
                                Tambah Terjemah
                            </a>
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Indonesia</th>
                        <th scope="col">English</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="table-group-divider">
                    @if ($terjemahans->isEmpty())
                        <tr>
                            <td class="text-center" colspan="7"><b>Tidak ada data</b></td>
                        </tr>
                    @else
                        @foreach ($terjemahans as $key => $terjemahan)
                            <tr>
                                <th scope="row">{{ $terjemahans->firstItem() + $key }}</th>
                                <td>
                                        
                                        <div class="d-flex justify-content-center" style="max-width: 150px; height: 120px;">
                                            <img class="mx-auto mh-100" src="{{ $terjemahan->image}}">
                                        </div>
                                </td>
                                <td>{{ $terjemahan->ind }}</td>
                                <td>{{ $terjemahan->en }}</td>
                                <td>
                                    @role(['admin', 'superadmin'])
                                    <a href="{{ route('admin.terjemahan.edit', $terjemahan->id) }}"
                                        class="d-block btn btn-primary w-100 mb-2">
                                        <i class="ti ti-edit"></i>
                                        Edit
                                    </a>
                                    @endrole
                                    @role('superadmin')
                                    <form action="{{ route('admin.terjemahan.destroy', $terjemahan->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger w-100"
                                            onclick="return confirm('Are you sure?');">
                                            <i class="ti ti-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                    @endrole
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>

            </table>

            <div class="d-flex justify-content-center">{{ $terjemahans->links() }}</div>
        </div>
    </div>
@endsection
