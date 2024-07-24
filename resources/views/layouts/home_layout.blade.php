<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Extra head e.g title -->
    @include('layouts.head')
</head>

<body class="position-relative">
    <!--  Body Wrapper -->
    <div class="background">
    </div>

    <div class="page-wrapper" id="main-wrapper">
        <!--  Main wrapper -->
        <div class="body-wrapper position-relative">
            @yield('back')
            <div class="container col-xxl-8 px-4 py-5" style="min-height: 100vh;">
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
    <!-- Extra scripts -->
    @yield('scripts')
</body>

</html>
