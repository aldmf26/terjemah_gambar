@extends('layouts.home_layout')
@section('content')
        <a class="float-end btn btn-outline-primary" href="{{ route('login') }}">Login</a>
    <div class="p-2 d-flex justify-content-center align-items-center">
        <div>
            <img src="https://th.bing.com/th/id/R.157f1fc536efff5c468d2d80d6964d08?rik=LKzNtuCOVxc8ZQ&riu=http%3a%2f%2fulm.ac.id%2fid%2fwp-content%2fuploads%2f2016%2f03%2fLogo-Unlam.png&ehk=dx%2f2aEaKiCgckr54LaCeU8Date5Rp6bSNR6IgSmV5cI%3d&risl=&pid=ImgRaw&r=0"
                width="150" height="150" alt="">
        </div>
        <div class="h6" style="font-size: 550%;">
            <b>|</b>
        </div>
        <div>
            <h4>WETLAND <br> DICTIONARY</h4>
        </div>

    </div>
    <div class="d-flex justify-content-center">
        <div>
            <h4 style="margin-top: 40px;"><b class="text-black">HI ! Welcome</b></h4>
            <p class="text-white">Terjemahan Bahasa Indonesia ke Bahasa Inggris <br> (khusus untuk kosakata lahan basah)</p>
            <button style="background-color: #1D129A" data-bs-toggle="modal" data-bs-target="#list" class="btn btn-primary">LIHAT LIST KATA </button>

            {{-- modal --}}
            <div class="modal fade text-left" id="list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">List Kata</h5>

                        </div>
                        <div class="modal-body">
                            <table id="myTable" class="table table-hover">
                                <thead class="bg-info text-white"> 
                                    <tr>
                                        <th class="text-center" width="10%">No</th>
                                        <th width="10">Indonesia</th>
                                        <th>Inggris</th>
                                        <th>Gambar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $i => $d)
                                        <tr>
                                            <td align="center">{{ $i+1 }}</td>
                                            <td>{{ $d->ind }}</td>
                                            <td>{{ $d->en }}</td>
                                            <td><img width="30%" class="img-fluid" src="{{ $d->image }}" alt=""></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
            <br class="">
            @livewire('form-terjemahan')
        </div>
    </div>
@endsection
