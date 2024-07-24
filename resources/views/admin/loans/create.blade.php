@extends('layouts.admin_layout', ['title' => $title])
@section('content')
    @include('components.alert')
    @include('components.kembali')
    <div class="card">
        <div class="card-body" x-data="{
            selected: [],
            pilih(id, cover, title, stok) {
                const index = this.selected.findIndex(book => book.id === id);
                if (index === -1) {
                    this.selected.push({
                        id: id,
                        cover: cover,
                        title: title,
                        stok: stok
                    });
                } else {
                    this.selected.splice(index, 1);
                }
            }
        }">
            <div class="row">
                <div class="col-12 col-lg-6" x-data="{
                    search: '',
                    btnDisabled: true
                }" @keyup.esc="search = ''"
                    @keyup="search !== '' ? btnDisabled = false : btnDisabled = true">
                    <h5 class="card-title fw-semibold mb-4">Pilih Buku</h5>
                    <div class="mb-4">
                        <label for="search" class="form-label">Cari Judul, pengarang atau penerbit buku</label>
                        <input type="text" class="form-control" id="search" name="search" placeholder="Cari buku"
                            x-model="search">
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <button class="btn btn-primary cari" :disabled="btnDisabled">Cari</button>
                </div>
                <div class="col-1 mb-3"></div>
                <div class="col-12 col-lg-5 d-flex flex-wrap">
                    <h5 class="card-title fw-semibold mb-4">Data Anggota</h5>
                    <div class="w-100 mb-4">

                        <table>
                            @php

                                $kolom = [
                                    'Nama Lengkap' => $users->first_name . ' ' . $users->last_name,
                                    'Email' => $users->user->email,
                                    'Nomor Telepon' => $users->phone,
                                    'alamat' => $users->address,
                                    'Tanggal Lahir' => \Carbon\Carbon::parse($users->date_of_birth)
                                        ->locale('id')
                                        ->isoFormat('D MMMM Y'),
                                    'Jenis Kelamin' => $users->gender,
                                ];
                            @endphp
                            @foreach ($kolom as $d => $i)
                                <tr>
                                    <td>
                                        <h6 class="text-black-50"><b>{{ $d }}</b></h6>
                                    </td>
                                    <td style="width:15px" class="text-center">
                                        <h6 class="text-black-50"><b>:</b></h6>
                                    </td>
                                    <td>
                                        <h6 class="text-black-50"><b>{{ $i }}</b></h6>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
            <div class="my-4">
                <h5 class="card-title fw-semibold mb-4">Buku dipilih</h5>
                <ul id="bookList" class="d-flex d-flex flex-wrap gap-2">
                    <template x-for="book in selected" :key="book.id">
                        <li :id="'book-' + book.id">
                            <div class="card border-2 border-primary overflow-hidden position-relative"
                                style="height: 160px; max-width: 355px;">
                                <div class="card-body">
                                    <img :src="`{{ asset('uploads/book_cover/') }}/${book.cover}`"
                                        class="position-absolute top-50 start-0 translate-middle-y border border-black me-4"
                                        style="height: 160px; width: 120px; object-fit: cover;">
                                    <div class="d-flex align-items-start" style="margin-left: 100px;">
                                        <div>
                                            <p
                                                style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; width: 150px;">
                                                <b x-text="book.title"></b>
                                            </p>
                                            <b x-text="`Sisa stock: ${book.stock}`"></b>
                                        </div>
                                        <div class="ps-2">
                                            <button type="button"
                                                @click="selected = selected.filter(b => b.id !== book.id)" class="btn">
                                                <i class="ti ti-x fs-8"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </template>
                    <li id="none" x-show="selected.length == 0">--Silahkan cari dan pilih buku terlebih dahulu--</li>
                </ul>
                <form id="bookForm" action="{{ route('admin.loans.new') }}" method="post">
                    @csrf
                    <div x-show="selected.length > 0">
                        <input type="hidden" name="uuid" value="{{$users->uuid}}">
                        <input type="hidden" name="book_id" :value="selected.map(book => book.id).join(',')">
                        <button id="confirmBook" class="btn btn-primary" type="submit">Konfirmasi</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="bookResult">
                        <p class="text-center mt-4">Data buku muncul disini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.cari').click(function(e) {
                e.preventDefault();
                var search = $('#search').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.loans.search') }}",
                    data: {
                        search: search
                    },
                    success: function(r) {
                        $("#bookResult").html(r);
                        $('html, body').animate({
                            scrollTop: $("#bookResult").offset().top
                        }, 500);
                    },
                    error: function(xhr, status, thrown) {
                        console.log(thrown);
                        $('#bookResult').html(thrown);
                    }
                });
            });


        });
    </script>
@endsection
@endsection
