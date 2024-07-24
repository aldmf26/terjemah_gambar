@extends('layouts.admin_layout', ['title' => $title])
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold">Form Edit Anggota</h5>
            <form action="{{ route('admin.members.update', $member->uuid) }}" method="post">
                @method('PUT')
                @csrf
                <div class="row mt-3">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="first_name" class="form-label">Nama depan</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                            name="first_name" value="{{ old('first_name') ?? $member->first_name }}" placeholder="John Doe" required>
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="last_name" class="form-label">Nama belakang</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                            name="last_name" value="{{ old('last_name') ?? $member->last_name }}" required>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') ?? $member->email }}" placeholder="johndoe@gmail.com" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="phone" class="form-label">Nomor telepon</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"
                            name="phone" value="{{ old('phone') ?? $member->phone }}" placeholder="+628912345" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" required>{{ old('address') ?? $member->address }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="date_of_birth" class="form-label">Tanggal lahir</label>
                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                            id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') ?? $member->date_of_birth }}" required>
                        @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label class="form-label">Jenis kelamin</label>
                        <div class="my-2 @error('gender') is-invalid @enderror">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="male" name="gender" value="1"
                                    {{ $member->gender == 'Male' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="male">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="female" name="gender" value="2"
                                    {{ $member->gender == 'Female' ? 'checked' : '' }} required>
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
                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
            </form>
        </div>
    </div>
@endsection

