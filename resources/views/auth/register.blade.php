
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

                    <div class="d-grid col-12 mx-auto m-3">
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
