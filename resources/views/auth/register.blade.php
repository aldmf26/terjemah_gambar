
@extends('layouts.home_layout',['title' => 'Daftar Baru'])
@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary m-3 position-absolute">
        <i class="ti ti-arrow-left"></i>
        Kembali
    </a>
    <div class="container d-flex justify-content-center p-5">
        <div class="card col-12 col-md-5 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-5">Silahkan Daftar</h5>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h6>Buat Akun</h6>
                    <div class="mb-2">
                        <input placeholder="Name" id="name" class="form-control" type="name" name="name"
                            :value="old('name')" required autofocus />
                    </div>
                    <div class="mb-2">
                        <input placeholder="Email" id="email" class="form-control" type="email" name="email"
                            :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mb-2">
                        <input placeholder="Password" id="password" class="form-control" type="password" name="password"
                            required autocomplete="current-password" />
                    </div>
                    <!-- Password -->
                    <div class="mb-2">
                        <input id="password_confirmation" class="form-control"
                        type="password"
                        name="password_confirmation" required placeholder="ulangi password" />
                    </div>
                    
                    <h6>Form Anggota Baru</h6>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="first_name" class="form-label">Nama depan</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                                name="first_name" value="{{ old('first_name') ?? '' }}" placeholder="John Doe" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label for="last_name" class="form-label">Nama belakang</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                name="last_name" value="{{ old('last_name') ?? '' }}">
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12 mb-3">
                            <label for="phone" class="form-label">Nomor telepon</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone') ?? '' }}" placeholder="+628912345" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" required>{{ old('address') ?? '' }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="date_of_birth" class="form-label">Tanggal lahir</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') ?? '' }}" required>
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label class="form-label">Jenis kelamin</label>
                            <div class="my-2 @error('gender') is-invalid @enderror">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="male" name="gender" value="1"
                                        {{ old('gender') ?? '' == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="male">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="female" name="gender" value="2"
                                        {{ old('gender') ?? '' == '2' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="female">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid col-12 mx-auto m-3">
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
