<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
    @php
        $title = isset($title) ? $title : "";
    @endphp
    <title>{{ $title }} | E-PERPUSJAR</title>
    <!-- Extra head e.g title -->
    @yield('head')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!--  Main wrapper -->
        <div class="body-wrapper">
            @include('layouts.header')

            <div class="container-fluid d-flex flex-wrap" style="min-height: 100vh;">
                <!-- Main content -->
                <div class="w-100">
                    @yield('content')
                </div>

                <div class="align-self-end w-100">
                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @include('layouts.scripts')
    <script src="{{ asset("assets/js/sidebarmenu.js") }}"></script>
    <script src="{{ asset("assets/js/app.min.js") }}"></script>
    <script src="{{ asset("assets/libs/simplebar/simplebar.js") }}"></script>
    @include('imports.scripts.admin')

    <!-- Extra scripts -->
    @yield('scripts')
</body>

</html>
