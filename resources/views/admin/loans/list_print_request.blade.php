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
                    
                </div>
            </div>
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Request By</th>
                        <th scope="col">Approved By</th>
                        <th scope="col">Halaman</th>
                        <th scope="col">Disetujui</th>
                        <th scope="col">Tercetak</th>
                        <th scope="col">Tgl</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @if ($requests->isEmpty())
                        <tr>
                            <td class="text-center" colspan="7"><b>Tidak ada data</b></td>
                        </tr>
                    @else
                        @foreach ($requests as $key => $req)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $req->name }}</td>
                                <td>{{ $req->approved_by_name ?? '-' }}</td>
                                <td>{{ $req->page }}</td>
                                <td class="text-center">
                                    @if ($req->is_approved == '0000-00-00 00:00:00')
                                    <span class="badge bg-warning rounded-3 fw-semibold">Belum Disetujui</span>
                                    @else
                                    <span class="badge bg-success rounded-3 fw-semibold">{{ \Carbon\Carbon::parse($req->is_approved)->format('Y/m/d H:i')}}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($req->is_printed == 'Y')
                                        <span class="badge bg-success rounded-3 fw-semibold">Dicetak</span>
                                    @else
                                        <span class="badge bg-warning rounded-3 fw-semibold">Belum Dicetak</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($req->date)->format('Y/m/d H:i') }}</td>
                                <td>
                                    <a  class="btn btn-outline-success @if($req->approved_by_name)disabled @endif" href="{{route('admin.loans.print_approve', $req->id)}}" > Izinkan</a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            {{-- <div class="d-flex justify-content-center">{{ $members->links() }}</div> --}}
        </div>
    </div>
@endsection
