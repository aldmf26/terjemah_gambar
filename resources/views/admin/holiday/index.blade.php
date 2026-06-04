@extends('layouts.admin_layout', ['title' => $title])

@section('content')
    @include('components.alert')

    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <h5 class="card-title fw-semibold mb-0">Data {{ $title }}</h5>
                </div>
            </div>

            <div class="row" x-data="{
                tambah:false
            }">
                <div class="col-md-12 mb-4">
                    <button @click="tambah =! tambah" type="button" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addHolidayModal">
                        <i class="ti ti-plus"></i> Tambah Hari Besar
                    </button>
                    <div x-show="tambah" x-transition class="card border shadow-none">
                        <div class="card-body p-3">
                            <h6 class="fw-semibold mb-3">Tambah Notifikasi</h6>
                            <form action="{{ route('admin.holiday.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-medium small">Nama Hari Besar</label>
                                    <input type="text" name="name" class="form-control form-control-sm" placeholder="Contoh: Hari Raya Idul Fitri" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium small">Tanggal Mulai</label>
                                    <input type="date" name="start_date" class="form-control form-control-sm" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium small">Tanggal Selesai</label>
                                    <input type="date" name="end_date" class="form-control form-control-sm" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium small">Pesan</label>
                                    <input type="text" name="icon_type" class="form-control form-control-sm" placeholder="Contoh: Semoga hari ini penuh berkah" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-medium small">Durasi Tampil (Detik)</label>
                                    <input type="number" name="display_duration" value="5" class="form-control form-control-sm" min="1" required>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary w-100">
                                    <i class="ti ti-plus"></i> Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Hari Besar</th>
                                <th>Periode</th>
                                <th>Pesan</th>
                                <th>Durasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notifications as $key => $item)
                                <tr>
                                    <td>{{ $notifications->firstItem() + $key }}</td>
                                    <td><span class="fw-semibold">{{ $item->name }}</span></td>
                                    <td>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light-primary text-primary text-uppercase font-monospace small px-2 py-1">{{ $item->icon_type }}</span>
                                    </td>
                                    <td>{{ $item->display_duration }}s</td>
                                    <td>
                                        <form action="{{ route('admin.holiday.destroy', $item->id) }}" method="post" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">{{ $notifications->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection