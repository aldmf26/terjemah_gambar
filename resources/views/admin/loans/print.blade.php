@extends('layouts.print_layout', ['title' => $title])
@section('content')
<table class="table table-bordered table-hover">
    <!-- Table header -->
    <thead class="table-light">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Peminjam</th>
            <th scope="col">Judul Buku</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Tanggal Pinjam</th>
            <th scope="col">Tenggat</th>
            <th scope="col">Tanggal Kembali</th>
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
                        <td scope="row">{{ $member->first_name . ' ' . $member->last_name }}</td>
                    <td>
                        <a class="text-decoration-none" href="{{ route('admin.books.show', $member->slug) }}">
                            <p class="">
                                <b>{{ $member->title . ' (' . $member->year . ')' }}</b>
                            </p>
                            <p class="text-body">Author: {{ $member->author }}</p>
                        </a>
                    </td>
                    <td>{{ $member->quantity }}</td>
                    <td>{{ \Carbon\Carbon::parse($member->loan_date)->format('Y/m/d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($member->due_date)->format('Y/m/d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($member->return_date)->format('Y/m/d') }}</td>
                
                </tr>
            @endforeach
        @endif
    </tbody>
    <!-- Table body with dynamic data -->

</table>
@endsection