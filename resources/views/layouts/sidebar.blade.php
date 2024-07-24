@php
    $auth = auth()->user();
    $superadmin = $auth->hasRole('superadmin');
    $admin = $auth->hasRole('admin');
    $pengguna = $auth->hasRole('pengguna');
    $kepala = $auth->hasRole('kepala');

    $sidebarNavs = [
        'Home',
        [
            'name' => 'Dashboard',
            'link' => 'dashboard',
            'icon' => 'ti ti-layout-dashboard',
        ],
    ];



    if ($pengguna || $admin || $superadmin || $kepala) {
        $sidebarNavs = array_merge($sidebarNavs, [
            'Transaksi',
            [
                'name' => 'Peminjaman',
                'link' => 'admin.loans.index',
                'icon' => 'ti ti-arrows-exchange',
            ],
            [
                'name' => 'Pengembalian',
                'link' => 'admin.returns.index',
                'icon' => 'ti ti-check',
            ],
            [
                'name' => 'Denda',
                'link' => 'admin.fines.index',
                'icon' => 'ti ti-report-money',
            ],
        ]);
    }
    
    if ($superadmin) {
        $sidebarNavs = array_merge($sidebarNavs, [
            'Master',
            [
                'name' => 'Anggota',
                'link' => 'admin.members.index',
                'icon' => 'ti ti-user',
            ],
            [
                'name' => 'Buku',
                'link' => 'admin.books.index',
                'icon' => 'ti ti-book',
            ],
            [
                'name' => 'Kategori',
                'link' => 'admin.categories.index',
                'icon' => 'ti ti-category-2',
            ],
            [
                'name' => 'Rak',
                'link' => 'admin.racks.index',
                'icon' => 'ti ti-columns',
            ],
        ]);
    }

    if ($superadmin) {
        $sidebarNavs = array_merge($sidebarNavs, [
            'Manajemen Akun',
            [
                'name' => 'Admin',
                'link' => 'admin.users.index',
                'icon' => 'ti ti-user-cog',
            ],
        ]);
    }

@endphp

<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <!-- Brand -->
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <div class="pt-4 mx-auto">
                <a href="{{ route('welcome') }}">
                    <h2>E-<span class="text-primary">PERPUSJAR</span></h2>
                </a>
            </div>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">

                @foreach ($sidebarNavs as $nav)
                    @if (gettype($nav) === 'string')
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">{{ $nav }}</span>
                        </li>
                    @else
                        <li class="sidebar-item ">
                            <a class="sidebar-link {{ request()->route()->getName() == $nav['link'] ? 'active' : '' }}"
                                href="{{ route($nav['link']) }}" aria-expanded="false">
                                <span>
                                    <i class="{{ $nav['icon'] }}"></i>
                                </span>
                                <span class="hide-menu">{{ $nav['name'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
