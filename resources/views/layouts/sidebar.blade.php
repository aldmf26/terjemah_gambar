@php
    $auth = auth()->user();
    $superadmin = $auth->hasRole('superadmin');
    $admin = $auth->hasRole('admin');
    $user = $auth->hasRole('user');

    $sidebarNavs = [
        'Home',
        [
            'name' => 'Dashboard',
            'link' => 'participant.user.dashboard',
            'icon' => 'ti ti-layout-dashboard',
        ],
    ];

    if ($user) {
        $sidebarNavs = array_merge($sidebarNavs, [
            [
                'name' => 'Daftar Quiz',
                'link' => 'participant.dashboard',
                'icon' => 'ti ti-bookmark',
            ],
            [
                'name' => 'Riwayat',
                'link' => 'participant.riwayat',
                'icon' => 'ti ti-timeline',
            ],
        ]);
    }

    if ($superadmin || $admin) {
        $sidebarNavs = array_merge($sidebarNavs, [
            'Master',

            [
                'name' => 'Data Terjemahan',
                'link' => 'admin.terjemahan.index',
                'icon' => 'ti ti-book',
            ],
            [
                'name' => 'Data Quiz',
                'link' => 'quizzes.index',
                'icon' => 'ti ti-book',
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
                    <h2>E-<span class="text-primary">TERJEMAHAN</span></h2>
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
