@extends('layouts.admin_layout', ['title' => 'Motivasi'])
@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
        <div class="card-header bg-white">
            <h4 class="fw-bold mb-0">Kelola Motivasi</h4>
        </div>
        <div class="card-body">
            <!-- Add new motivasi form -->
            <form action="{{ route('admin.motivasi.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="input-group">
                    <input type="text" name="motivasi" class="form-control" placeholder="Masukkan kalimat motivasi" required>
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </div>
            </form>

            <!-- List existing motivasi -->
            @if(count($motivasi) > 0)
                <ul class="list-group">
                    @foreach($motivasi as $idx => $text)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $text }}
                            <form action="{{ route('admin.motivasi.destroy', $idx) }}" method="POST" onsubmit="return confirm('Hapus motivasi ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">✕</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">Belum ada motivasi.</p>
            @endif
        </div>
    </div>
</div>
@endsection
