@extends('layouts.admin_layout', ['title' => 'Dashboard'])
@section('content')
<div class="row">
    <!-- BOOKS -->
    <div class="col-lg-3 col-sm-6">
        <a href="{{ route('admin.books.index') }}">
            <div class="card">
                <div class="card-body">
                    <h2>
                        <i class="ti ti-book"></i>
                    </h2>
                    <h3>
                        {{ count($books) }} Buku
                    </h3>
                </div>
            </div>
        </a>
    </div>
    <!-- BOOK STOCK -->
    <div class="col-lg-3 col-sm-6">
        <a href="{{ route('admin.books.index') }}">
            <div class="card">
                <div class="card-body">
                    <h2>
                        <i class="ti ti-database"></i>
                    </h2>
                    <h3>
                        {{ $totalBookStock }} Stok Buku
                    </h3>
                </div>
            </div>
        </a>
    </div>
    <!-- RACKS -->
    <div class="col-lg-3 col-6">
        <a href="{{ route('admin.racks.index') }}">
            <div class="card">
                <div class="card-body">
                    <h2>
                        <i class="ti ti-columns"></i>
                    </h2>
                    <h3>
                        {{ count($raks) }} Rak Buku
                    </h3>
                </div>
            </div>
        </a>
    </div>
    <!-- CATEGORIES -->
    <div class="col-lg-3 col-6">
        <a href="{{ route('admin.categories.index') }}">
            <div class="card">
                <div class="card-body">
                    <h2>
                        <i class="ti ti-category-2"></i>
                    </h2>
                    <h3>
                        {{ count($categories) }} Kategori
                    </h3>
                </div>
            </div>
        </a>
    </div>
    </div>

    <div class="row">
        <!-- MEMBER -->
        <div class="col-sm-6">
            <a href="{{ route('admin.members.index') }}">
                <div class="card">
                    <div class="card-body">
                        <h2>
                            <i class="ti ti-user"></i>
                        </h2>
                        <h3>
                            {{ count($members) }} Anggota
                        </h3>
                    </div>
                </div>
            </a>
        </div>
        <!-- LOANS -->
        <div class="col-sm-6">
            <a href="{{ route('admin.loans.index') }}">
                <div class="card">
                    <div class="card-body">
                        <h2>
                            <i class="ti ti-arrows-exchange"></i>
                        </h2>
                        <h3>
                            {{ count($loans) }} Transaksi Peminjaman
                        </h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
