@extends('layouts.admin_layout', ['title' => 'Dashboard'])
@section('content')
<div class="row">
    <!-- BOOKS -->
    <div class="col-lg-3 col-sm-6">
        <a href="{{ route('admin.terjemahan.index') }}">
            <div class="card">
                <div class="card-body">
                    <h2>
                        <i class="ti ti-book"></i>
                    </h2>
                    <h3>
                        tes
                    </h3>
                </div>
            </div>
        </a>
    </div>
   
</div>
@endsection
