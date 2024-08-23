@extends('layouts.admin_layout', ['title' => $title])
@section('content')
    @include('components.alert')

    <div class="card">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12 col-lg-5">
                    <h5 class="card-title fw-semibold mb-4">Data Admin</h5>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="d-flex gap-2 justify-content-md-end">
                        <div>
                            {{-- <form action="" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="search" value="<?= $search ?? '' ?>"
                                        placeholder="Cari anggota" aria-label="Cari anggota"
                                        aria-describedby="searchButton">
                                    <button class="btn btn-outline-secondary" type="submit" id="searchButton">Cari</button>
                                </div>
                            </form> --}}
                        </div>
                        <div>
                            <a data-bs-toggle="modal" data-bs-target="#tambah" href="#"
                                class="btn btn-primary py-2">
                                <i class="ti ti-plus"></i>
                                Tambah Admin Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tanggal dibuat</th>
                        <th scope="col" class="text-center">Group</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="table-group-divider">
                    @if ($users->isEmpty())
                        <tr>
                            <td class="text-center" colspan="7"><b>Tidak ada data</b></td>
                        </tr>
                    @else
                        @foreach ($users as $key => $d)
                            <tr>
                                <th scope="row">{{ $users->firstItem() + $key }}</th>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->email }}</td>
                                <td>{{ $d->created_at }}</td>
                                <td class="text-center">
                                    @if ($d->hasRole('superadmin'))
                                        <span class="badge bg-success rounded-3 fw-semibold text-black">Superadmin</span>
                                    @elseif ($d->hasRole('admin'))
                                        <span class="badge bg-primary rounded-3 fw-semibold">Admin</span>
                                    @elseif ($d->hasRole('kepala'))
                                        <span class="badge bg-info rounded-3 fw-semibold">Kepala</span>
                                    @else
                                        <span class="badge bg-black rounded-3 fw-semibold">Pengguna</span>
                                    @endif
                                </td>
                                <td align="center">
                                        <a href="{{ route('admin.users.edit', $d->id) }}" class="btn btn-primary mb-2">
                                            <i class="ti ti-edit"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $d->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"
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

            <div class="d-flex justify-content-center">{{ $users->links() }}</div>
        </div>
    </div>

    <form action="{{ route('admin.users.store') }}" method="post">
        @csrf
        <x-modal title="Tambah Admin" idModal="tambah">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-2 form-group">
                        <label for="name">Name</label>
                        <input placeholder="Name" id="name" class="form-control" type="name" name="name"
                            :value="old('name')" required autofocus />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-2 form-group">
                        <label for="email">Email</label>

                        <input placeholder="Email" id="email" class="form-control" type="email" name="email"
                            :value="old('email')" required autofocus />
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Password -->
                    <div class="mb-2 form-group">
                        <label for="password">Password</label>
                        <input placeholder="Password" id="password" class="form-control" type="password" name="password"
                            required autocomplete="current-password" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Password -->
                    <div class="mb-2 form-group">
                        <label for="password">Ulangi Password</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation"
                            required placeholder="ulangi password" />
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="mb-2 form-group">
                        <label for="">Role</label>
                        <select required name="role" class="form-control select2" id="">
                            <option value="">- Pilih Role -</option>
                            @php
                                $roles = ['admin', 'superadmin'];
                            @endphp
                            @foreach ($roles as $r)
                                <option value="{{ $r }}">{{ $r }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


        </x-modal>
    </form>
@endsection
