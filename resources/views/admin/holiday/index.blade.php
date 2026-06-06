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

           <div class="row" x-data="{ tambah:false }">
    <div class="col-md-12 mb-4">
        <button @click="tambah = ! tambah" type="button" class="btn btn-sm btn-primary mb-3">
            <i class="ti ti-plus"></i> Tambah Hari Besar
        </button>
        <div x-show="tambah" x-transition class="card border shadow-none">
            <div class="card-body p-3">
                <h6 class="fw-semibold mb-3">Tambah Notifikasi Hari Besar</h6>
                <form action="{{ route('admin.holiday.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-medium small">Nama Hari Besar</label>
                        <input type="text" name="name" class="form-control form-control-sm" placeholder="Contoh: Hari Raya Idul Fitri" required>
                    </div>
                    
                    <!-- INPUT PILIH ICON -->
                    <div class="mb-3">
                        <label class="form-label fw-medium small">Pilih Icon / Simbol</label>
                        <select name="icon_type" class="form-select form-select-sm" required>
                            <option value="">-- Pilih Icon Hari Besar --</option>
                            <option value="ti ti-moon">🌙 Idul Fitri / Idul Adha (Bulan/Masjid)</option>
                            <option value="ti ti-christmas-tree">🎄 Hari Raya Natal (Pohon Natal)</option>
                            <option value="ti ti-lantern">🏮 Tahun Baru Imlek (Lampion)</option>
                            <option value="ti ti-lotus">🪷 Hari Raya Waisak / Nyepi (Teratai)</option>
                            <option value="ti ti-flag">🇮🇩 Hari Kemerdekaan RI (Bendera)</option>
                            <option value="ti ti-confetti">🎉 Tahun Baru Masehi (Pesta/Petasan)</option>
                            <option value="ti ti-hammer">🔨 Hari Buruh (Palu)</option>
                            <option value="ti ti-shield-half">🛡️ Hari Nasional / Pancasila (Perisai)</option>
                            <option value="ti ti-bell">🔔 Hari Besar Lainnya (Lonceng/Umum)</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium small">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium small">Tanggal Selesai</label>
                            <input type="date" name="end_date" class="form-control form-control-sm" required>
                        </div>
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

    <!-- TAMPILAN TABEL -->
    <div class="col-md-12 mb-4">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Hari Besar</th>
                    <th>Icon</th> <!-- Kolom baru untuk Icon -->
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
                            <!-- Menampilkan Icon Hidup secara Visual -->
                            <span class="badge bg-light-secondary text-secondary p-2 fs-5">
                                <i class="{{ $item->icon_type }}"></i>
                            </span>
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}
                            </small>
                        </td>
                        <td>{{ $item->message }}</td>
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
                        <td colspan="7" class="text-center">Tidak ada data</td>
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