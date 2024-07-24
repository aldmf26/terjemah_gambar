<!--  Header Start -->
<style>
    @media only screen and (max-width: 768px) {
        #navBtn {
            display: none;
        }
    }
</style>
<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end gap-2" id="headerCollapse">
                @role(['superadmin', 'kepala'])
                    <li class=" nav-item" id="navBtn">
                        <a href="{{route('admin.loans.list_print_request')}}" class="btn btn-success">Permintaan Cetak</a>
                    </li>
                @endrole
                {{-- <li class="nav-item" id="navBtn">
                    <a href="#" target="_blank" class="btn btn-outline-primary">Pengembalian buku</a>
                </li>
                <li class="nav-item" id="navBtn">
                    <a href="#" target="_blank" class="btn btn-outline-warning">Bayar denda</a>
                </li> --}}
                <li class="nav-item dropdown">
                    @role('pengguna')
                        <a class="nav-link nav-icon-hover position-relative" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img alt="" width="35" height="35" class="rounded-circle border border-warning"
                                style="background-color: white;">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning"
                                id="notifCount" style="display: none;"></span>
                            <i class="ti ti-bell position-absolute top-50 start-50 translate-middle text-warning"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" style="min-width: 300px;"
                            aria-labelledby="drop2">
                            <div class="message-body">
                                <div class="mx-3 mt-2">
                                    <h5>Notifikasi</h5>
                                    <div id="notifList">
                                        <p>Tidak ada notifikasi baru</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endrole
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" style="min-width: 300px;"
                        aria-labelledby="drop2">
                        <div class="message-body">
                            <div class="mx-3 mt-2">
                                <h5>Profil</h5>
                                @auth
                                    <span>name: <b>{{ auth()->user()->name }}</b></span><br>
                                    <span>email: <b>{{ auth()->user()->email }}</b></span><br>
                                    <span>level: {{ auth()->user()->roles->first()->name }}</span>
                                @endauth

                            </div>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</button>
                            </form>
                        </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover position-relative" href="javascript:void(0)" id="drop2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img alt="" width="35" height="35" class="rounded-circle border border-primary"
                            style="background-color: white;">
                        <i class="ti ti-user position-absolute top-50 start-50 translate-middle text-primary"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" style="min-width: 300px;"
                        aria-labelledby="drop2">
                        <div class="message-body">
                            <div class="mx-3 mt-2">
                                <h5>Profil</h5>
                                @auth
                                    <span>name: <b>{{ auth()->user()->name }}</b></span><br>
                                    <span>email: <b>{{ auth()->user()->email }}</b></span><br>
                                    <span>level: {{ auth()->user()->roles->first()->name }}</span>
                                @endauth

                            </div>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</button>
                            </form>
                        </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!--  Header End -->
