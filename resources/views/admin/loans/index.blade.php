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
                        </div>
                        <div class="d-flex gap-1">
                            @role(['superadmin', 'kepala'])
                                <a class="btn btn-success" href="{{route('admin.loans.print')}}"><i class="ti ti-printer"></i> Cetak</a>
                            @endrole

                            @role('admin')
                                <div>
                                    @if (auth()->user()->hasPrintPermission('peminjaman'))
                                        <a class="btn btn-success" href="{{route('admin.loans.print')}}"><i class="ti ti-printer"></i> Cetak</a>
                                    @else
                                        <form action="{{ route('admin.loans.print_request') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="page" value="peminjaman">
                                            <button type="submit" class="btn btn-info" href=""><i
                                                    class="ti ti-printer"></i> Minta Cetak Data</button>
                                        </form>
                                    @endif
                                </div>
                            @endrole
                            @role('pengguna')
                                <a href="{{ route('admin.loans.create') }}" class="btn btn-primary py-2">
                                    <i class="ti ti-plus"></i>
                                    Peminjaman Baru
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
                        @if (!auth()->user()->hasRole('pengguna'))
                            <th scope="col">Nama Peminjam</th>
                        @endif
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Tgl Pinjam</th>
                        <th scope="col">Tenggat</th>
                        <th scope="col">Status</th>
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
                                @if (!auth()->user()->hasRole('pengguna'))
                                    <td scope="row">{{ $member->first_name . ' ' . $member->last_name }}</td>
                                @endif
                                <td>
                                    <a href="{{ route('admin.books.show', $member->slug) }}">
                                        <p class="text-primary-emphasis text-decoration-underline">
                                            <b>{{ $member->title . ' (' . $member->year . ')' }}</b>
                                        </p>
                                        <p class="text-body">Author: {{ $member->author }}</p>
                                    </a>
                                </td>
                                <td>{{ $member->quantity }}</td>
                                <td>{{ \Carbon\Carbon::parse($member->loan_date)->format('Y/m/d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($member->due_date)->format('Y/m/d') }}</td>
                                <td class="text-center">
                                    @if (now()->isBefore($member->due_date))
                                        <span class="badge bg-success rounded-3 fw-semibold">Normal</span>
                                    @elseif (now()->isSameDay($member->due_date))
                                        <span class="badge bg-warning rounded-3 fw-semibold">Jatuh tempo</span>
                                    @else
                                        <span class="badge bg-danger rounded-3 fw-semibold">Terlambat</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.loans.show', $member->id) }}"
                                        class="d-block btn btn-primary w-100 mb-2">
                                        Detail
                                    </a>
                                </td>
                                {{-- <td>
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
                                </td> --}}
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <div class="d-flex justify-content-center">{{ $members->links() }}</div>
        </div>
    </div>
@endsection
