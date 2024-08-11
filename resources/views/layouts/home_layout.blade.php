<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Extra head e.g title -->
    @include('layouts.head')
    
    @livewireStyles
</head>

<style>
    body {
        background-image: url('{{ asset('uploads/bg.jpeg') }}');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-position: center;
        color:black;
    }
 
</style>
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
    <script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
    @livewireScripts
</body>

</html>
