@extends('layouts.admin_layout', ['title' => $title])
@section('content')
    @include('components.alert')
    
    <form action="{{ route('admin.users.update', $user->id) }}" method="post" id="update">
        @csrf
        <div class="card mb-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-2 form-group">
                            <label for="name">Name</label>
                            <input placeholder="Name" id="name" class="form-control" type="name" name="name"
                                value="{{ $user->name }}" required autofocus />

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-2 form-group">
                            <label for="email">Email</label>

                            <input value="{{ $user->email }}" placeholder="Email" id="email" class="form-control"
                                type="email" name="email" :value="old('email')" required autofocus />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Password -->
                        <div class="mb-2 form-group">
                            <label for="password">Password</label>
                            <input placeholder="Password" id="password" class="form-control" type="password"
                                name="password" required autocomplete="current-password" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Password -->
                        <div class="mb-2 form-group">
                            <label for="password">Ulangi Password</label>
                            <input id="password_confirmation" class="form-control" type="password"
                                name="password_confirmation" required placeholder="ulangi password" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-2 form-group">
                            <label for="">Role</label>
                            <select name="role" class="form-control select2" id="">
                                <option value="">- Pilih Role -</option>
                                @php
                                    $roles = ['admin', 'kepala', 'superadmin', 'pengguna'];
                                @endphp
                                @foreach ($roles as $r)
                                    <option value="{{ $r }}" {{ $user->hasRole($r) ? 'selected' : '' }}>
                                        {{ $r }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary float-end" type="submit">Save</button>
            </div>
        </div>
    </form>
@endsection
