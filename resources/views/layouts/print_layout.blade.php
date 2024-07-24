<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan */
        
    </style>
</head>

<body class="p-2">
    <!-- Header -->
    <div class="text-center">
        <h1>Dinas Perpustakaan dan Kearsipan<br>Provinsi Kalimantan Selatan</h1>
        <p>Jl. A. Yani Km. 6,400 No. 6, Pemurus Luar<br>Kec. Banjarmasin Timur., Kota Banjarmasin<br>Kalimantan Selatan
            70249</p>
    </div>

    <!-- Main container -->
    <div class="">
        <!-- Card for the report -->
        <div class="card">
            <div class="card-body">
                @php
                    $title = isset($title) ? $title : '';
                @endphp
                <!-- Report title -->
                <h2 class="card-title fw-bold mb-4 text-center">Laporan Data {{$title}}</h2>

                <!-- Table for displaying data -->
                <div class="table-responsive">
                    @yield('content')
                </div>
                <!-- End of table-responsive -->
            </div>
        </div>
        <!-- End of card -->
    </div>
    <!-- End of main container -->
<script>
    window.print()
</script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
