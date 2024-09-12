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
            <li class="nav-item dropdown d-flex gap-2 d-xl-none">

                {{-- <a href="" class="btn btn-sm btn-outline-primary">Data terjemahan</a>
                <a href="" class="btn btn-sm btn-outline-primary">Data user</a>
                <a href="" class="btn btn-sm btn-danger">Logout</a> --}}
                <a class="nav-link sidebartoggler nav-icon-hover" id="drop4" data-bs-toggle="dropdown"
                    href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" style="min-width: 300px;"
                    aria-labelledby="drop4">
                    <div class="message-body">
                        <div class="mx-3 mt-2">
                            <ul class="d-flex gap-2">
                                @role(['admin', 'superadmin'])
                                <li><a href="{{ route('admin.terjemahan.index') }}" class="btn btn-sm btn-outline-primary">Data Terjemahan</a></li>
                                @endrole
                                @role('superadmin')
                                <li><a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">Admin</a></li>
                                @endrole
                            </ul>
                        </div>

                    </div>
                </div>
            </li>
        </ul>

        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end gap-2" id="headerCollapse">
                <li class="nav-item dropdown ">
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
                    </div>
                </li>

            </ul>
        </div>
    </nav>
</header>
<!--  Header End -->
