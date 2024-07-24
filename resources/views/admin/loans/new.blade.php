@extends('layouts.admin_layout', ['title' => $title])
@section('content')
    @include('components.alert')

    <form action="{{ route('admin.loans.store') }}" method="post">
        @csrf
        <input type="hidden" name="member_uid" value="{{ $users->uuid }}">
        <!-- Member -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-3">Data Anggota</h5>
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="member_name" class="form-label">Nama anggota</label>
                        <input type="text" class="form-control" id="member_name" name="member_name"
                            value="{{ $users->first_name }} {{ $users->last_name }}" disabled>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="member_email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="member_email" name="member_email"
                            value="{{ $users->email }}" disabled>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="member_phone" class="form-label">Nomor telepon</label>
                        <input type="text" class="form-control" id="member_phone" name="member_phone"
                            value="{{ $users->phone }}" disabled>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="member_address" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="member_address" name="member_address"
                            value="{{ $users->address }}" disabled>
                    </div>
                </div>
            </div>
        </div>
        <!-- Loan -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Form Peminjaman Buku</h5>
            <div class="row">
              @foreach ($books as $index => $book)
            
                <input type="hidden" name="slugs[]" value="{{ $book->slug }}">
                <div class="col-12">
                  <div class="card border border-2 border-primary overflow-hidden position-relative">
                    <div class="card-body">
                      <img src="{{ asset('uploads/book_cover/' . $book->book_cover ?? 'default.jpg') }}"
                           class="position-absolute top-50 start-0 translate-middle-y border border-black me-4"
                           style="height: 160px; width: 120px; object-fit: cover;"
                           alt="{{ $book->title }}">
                      <div class="row">
                        <div class="col-5">
                          <div class="d-flex align-items-start" style="margin-left: 100px;">
                            <div>
                              <p style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                <b>{{$book->title}} ({{$book->year}})</b>
                            </p>
                              <p>Pengarang: {{ $book->author }}</p>
                              <p>Penerbit: {{ $book->publisher }}</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-2">
                          <label for="quantity-{{ $book->slug }}" class="form-label">Jumlah</label>
                          <input type="number" class="form-control " id="quantity-{{ $book->slug }}" name="quantity[]" value="1" placeholder="max=10" max="{{ $book->stock }}" min="1" aria-describedby="bookStock" required>
                          <input type="hidden" class="form-control " id="quantity-{{ $book->slug }}" name="book_id[]" value="{{ $book->id }}" required>
                          <div class="invalid-feedback">
                            @error('quantity.' . $book->slug)
                              {{ $message }}
                            @enderror
                          </div>
                          <div id="bookStock" class="form-text">Stok: {{ $book->stock }}</div>
                        </div>
                        <div class="col-5">
                          <label class="form-label">Lama meminjam</label>
                          <div class="my-2 ">
                            @foreach ([7, 14, 30] as $i=>$d)
                            <div class="form-check form-check-inline">
                              <input type="radio" class="form-check-input" id="{{ $d }}days-{{ $book->slug }}" name="duration[{{ $index }}]" value="{{ $d }}" {{ old("duration-{$book->slug}") ?? '' == $d ? 'checked' : '' }} required>
                              <label class="form-check-label" for="{{ $d }}days-{{ $book->slug }}">
                                {{ $d }} hari
                              </label>
                            </div>
                            @endforeach
                          </div>
                          <div class="invalid-feedback">
                            {{ $errors->first("duration-{$book->slug}") }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
    </form>
@endsection
