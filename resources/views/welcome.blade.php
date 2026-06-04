@extends('layouts.home_layout')
@section('content')
    <div class="position-absolute top-0 start-0 end-0 p-3" style="z-index: 10;">
        <div class="d-flex justify-content-between align-items-start" style="gap: 1rem;">
            <div id="holiday-container" class="d-flex align-items-start d-none d-sm-block"
                style="min-width: 260px; max-width: 420px;">
                @forelse ($activeHoliday as $item)
                    <div id="holiday-overlay-desktop-{{ $item->id }}"
                        class="sm:d-none px-3 py-2 transition-all duration-500 ease-in-out" style="opacity: 1; width: 100%;">
                        <style>
                            .glass-banner {
                                backdrop-filter: blur(12px);
                                -webkit-backdrop-filter: blur(12px);
                                border-radius: 18px;
                                border: 1px solid rgba(255, 255, 255, 0.18);
                                box-shadow: 0 18px 40px rgba(0, 0, 0, 0.25);
                                background: rgba(15, 23, 42, 0.78);
                            }
                        </style>

                        <div class="glass-banner d-flex align-items-center justify-content-between p-3 text-white"
                            style="gap: 0.75rem;">
                            <div class="d-flex align-items-start gap-3">
                                <div style="text-align: left;">
                                    <span class="d-block fw-semibold text-cyan-300"
                                        style="margin-bottom: 0.25rem; font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase;">
                                        Peringatan Hari Ini
                                    </span>
                                    <h6 class="mb-0 fw-bold"
                                        style="font-size: 0.95rem; color: #fff; text-shadow: 0 1px 2px rgba(0,0,0,0.45);">
                                        {{ $item->name }}
                                    </h6>
                                    <p class="mb-0" style="font-size: 0.78rem; color: rgba(248, 250, 252, 0.88);">
                                        {{ $item->icon_type }}
                                    </p>
                                </div>
                            </div>
                            <button onclick="hideHolidayNotification('desktop-{{ $item->id }}')"
                                class="btn-close btn-close-white opacity-80" style="font-size: 0.75rem;"
                                aria-label="Close"></button>
                        </div>
                    </div>

                    <script>
                        // Fungsi penutupan internal dipindahkan ke global script di bawah agar tidak terduplikasi secara ilegal
                    </script>
                @empty
                @endforelse

            </div>

            <div class="d-flex align-items-center ms-auto">
                <a class="btn btn-warning fw-bold shadow-sm px-3 py-1 small"
                    style="border-radius: 20px; background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); border: none; font-size: 0.85rem;"
                    href="{{ route('login') }}">
                    <i class="ti ti-lock"></i> Login
                </a>
            </div>
        </div>
    </div>

    <div class="p-2 d-flex justify-content-center align-items-center pt-3">
        <div>
            <img src="https://th.bing.com/th/id/R.157f1fc536efff5c468d2d80d6964d08?rik=LKzNtuCOVxc8ZQ&riu=http%3a%2f%2fulm.ac.id%2fid%2fwp-content%2fuploads%2f2016%2f03%2fLogo-Unlam.png&ehk=dx%2f2aEaKiCgckr54LaCeU8Date5Rp6bSNR6IgSmV5cI%3d&risl=&pid=ImgRaw&r=0"
                width="90" height="90" class="img-fluid" alt="Logo ULM"
                style="filter: drop-shadow(0 4px 8px rgba(0,0,0,0.4));">
        </div>
        <div class="h6 mx-2 text-white" style="font-size: 300%; font-weight: 200; opacity: 0.7;">
            <b>|</b>
        </div>
        <div class="text-start">
            <h4 class="fw-bolder tracking-wider text-white mb-0"
                style="font-family: 'Poppins', sans-serif; text-shadow: 0 2px 4px rgba(0,0,0,0.6); font-size: 1.4rem; line-height: 1.2;">
                WETLAND <br><span class="text-warning">DICTIONARY</span>
            </h4>
        </div>
    </div>

    <div class="d-flex justify-content-center px-3">
        <div class="text-center w-100 mx-auto" style="max-width: 500px;">
            <h4 style="margin-top: 10px;"><b class="text-warning"
                    style="text-shadow: 0 2px 4px rgba(0,0,0,0.7); font-size: 1.5rem;">HI ! Welcome</b></h4>
            <p class="text-white small" style="text-shadow: 0 1px 3px rgba(0,0,0,0.6); line-height: 1.4;">
                Terjemahan Bahasa Indonesia ke Bahasa Inggris <br>
                <span class="text-white fw-medium">(khusus untuk kosakata lahan basah)</span>
            </p>

            <div style="margin-bottom: 70px;" class="d-grid gap-2 col-12 mx-auto justify-content-center">
                <button
                    style="background: linear-gradient(135deg, #1D129A 0%, #0d066b 100%); border: none; border-radius: 30px;"
                    data-bs-toggle="modal" data-bs-target="#list"
                    class="btn btn-primary px-4 py-2 fw-bold shadow-sm btn-sm">
                    <i class="ti ti-list"></i> LIHAT LIST KATA
                </button>
            </div>

            {{-- modal --}}
            <div class="modal fade text-left" id="list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
                    <div class="modal-content shadow-lg" style="border-radius: 16px; border: none; overflow: hidden;">
                        <div class="modal-header bg-light border-0 py-3">
                            <h5 class="modal-title fw-bold text-dark fs-6" id="myModalLabel1"><i
                                    class="ti ti-notebook text-primary me-2"></i>List Kata Lahan Basah</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-hover align-middle mb-0"
                                    style="font-size: 0.9rem;">
                                    <thead class="text-white" style="background-color: #1D129A">
                                        <tr>
                                            <th class="text-center py-2" width="10%">No</th>
                                            <th width="35%">Indonesia</th>
                                            <th width="35%">Inggris</th>
                                            <th width="20%">Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list as $i => $d)
                                            <tr>
                                                <td align="center" class="fw-bold text-muted small">{{ $i + 1 }}</td>
                                                <td class="fw-semibold text-dark">{{ $d->ind }}</td>
                                                <td
                                                    class="text-primary @if (empty($d->en)) text-muted small @else fst-italic @endif">
                                                    {{ $d->en ?? 'Belum ada terjemahan' }}</td>
                                                <td>
                                                    <img data-bs-target="#detailGambar{{ $d->id }}"
                                                        data-bs-toggle="modal"
                                                        style="cursor: pointer; object-fit: cover; border-radius: 6px; max-height: 45px; width: 60px;"
                                                        class="img-fluid img-thumbnail"
                                                        src="{{ strpos($d->image, 'http') !== false ? $d->image : asset('/uploads/' . $d->image) }}"
                                                        alt="Thumb">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer border-0 bg-light py-2">
                            <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal"
                                style="border-radius: 20px;">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($list as $i => $d)
                <div class="modal fade text-left" id="detailGambar{{ $d->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content shadow-lg border-0" style="border-radius: 12px; overflow: hidden;">
                            <div
                                class="modal-header p-2 bg-dark text-white border-0 d-flex justify-content-between align-items-center">
                                <h5 class="modal-title small fw-bold mb-0">Preview: {{ $d->ind }}</h5>
                                <button type="button" class="btn-close btn-close-white" style="font-size: 0.65rem;"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0 bg-black d-flex justify-content-center">
                                <img src="{{ strpos($d->image, 'http') !== false ? $d->image : asset('/uploads/' . $d->image) }}"
                                    class="img-fluid w-100" style="max-height: 60vh; object-fit: contain;"
                                    alt="Zoom">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <br>
            @livewire('form-terjemahan')

            {{-- HOLIDAY CONTAINER - MOBILE ONLY (Bottom) --}}
            @forelse ($activeHoliday as $item)
                <div id="holiday-container-mobile-{{ $item->id }}" class="d-sm-none px-2 pb-1">
                    <div id="holiday-overlay-mobile-{{ $item->id }}"
                        class="px-1 py-2 transition-all duration-500 ease-in-out">

                        {{-- <div class="glass-banner d-flex align-items-center justify-content-between p-3 text-white"
                             style="gap: 0.75rem; border-radius: 18px;">
                            <div class="d-flex align-items-start gap-3">
                                <div style="text-align: left;">
                                    <span class="d-block fw-semibold text-cyan-300"
                                        style="margin-bottom: 0.25rem; font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase;">
                                        Peringatan Hari Ini
                                    </span>
                                    <h6 class="mb-0 fw-bold"
                                        style="font-size: 0.95rem; color: #fff; text-shadow: 0 1px 2px rgba(0,0,0,0.45);">
                                        {{ $item->name }}
                                    </h6>
                                    <p class="mb-0" style="font-size: 0.78rem; color: rgba(248, 250, 252, 0.88);">
                                        {{$item->icon_type}}
                                    </p>
                                </div>
                            </div>
                            <button onclick="hideHolidayNotification('mobile-{{ $item->id }}')" 
                                    class="btn-close btn-close-white opacity-80"
                                    style="font-size: 0.75rem;" aria-label="Close"></button>
                        </div> --}}

                        {{-- <button
                    style="background: linear-gradient(135deg, #1D129A 0%, #0d066b 100%); border: none; border-radius: 30px;"
                    data-bs-toggle="modal" data-bs-target="#list"
                    class="btn btn-primary px-4 py-2 fw-bold shadow-sm btn-sm">
                    <i class="ti ti-list"></i> LIHAT LIST KATA
                </button> --}}

                        {{-- dimobvile ini saya mau hari besarnya itu seperti button itu aja tapi ganti pakai span aja kan bisa beri margin --}}

                        {{-- <div class="d-flex align-items-center justify-content-between p-3 text-white"
                            style="gap: 0.75rem; border-radius: 18px; background: linear-gradient(135deg, #1D129A 0%, #0d066b 100%);">
                            <div class="d-flex align-items-start gap-3">
                                <div style="text-align: left;">
                                    <span class="d-block fw-semibold text-cyan-300"
                                        style="margin-bottom: 0.25rem; font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase;">
                                        Peringatan Hari Ini
                                    </span>
                                    <h6 class="mb-0 fw-bold"
                                        style="font-size: 0.95rem; color: #fff; text-shadow: 0 1px 2px rgba(0,0,0,0.45);">
                                        {{ $item->name }}
                                    </h6>
                                    <p class="mb-0" style="font-size: 0.78rem; color: rgba(248, 250, 252, 0.88);">
                                        {{ $item->icon_type }}
                                    </p>
                                </div>
                            </div>
                            <button onclick="hideHolidayNotification('mobile-{{ $item->id }}')"
                                class="btn-close btn-close-white opacity-80" style="font-size: 0.75rem;"
                                aria-label="Close"></button>
                        </div> --}}

                        <button
                            style=""
                            class="glass-banner btn btn-primary p-2 fw-bold shadow-sm btn-sm">
                            {{ $item->name }} <br> <em>"{{ $item->icon_type }}"</em>
                        </button>
                       
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>

    <script>
        // Perbaikan: Fungsi menerima penamaan ID dinamis agar dapat menghapus element mana saja secara spesifik
        function hideHolidayNotification(fullIdSuffix) {
            const overlay = document.getElementById(`holiday-overlay-${fullIdSuffix}`);
            if (!overlay) return;

            overlay.style.transition = 'opacity 0.5s ease';
            overlay.style.opacity = '0';
            setTimeout(() => {
                overlay.style.display = 'none';
                // Ambil elemen container mobile jika itu pembungkus mobile agar spacing margin bawahnya ikut bersih
                const containerMobile = document.getElementById(`holiday-container-${fullIdSuffix}`);
                if (containerMobile) containerMobile.style.display = 'none';
            }, 500);
        }

        // Perbaikan: Setiap item di dalam loop mendaftarkan timer autohide miliknya sendiri secara independen
        @forelse ($activeHoliday as $item)
            document.addEventListener('DOMContentLoaded', function() {
                const duration = {{ $item->display_duration * 1000 }};

                // Desktop Auto Hide per item
                setTimeout(() => {
                    const overlayDesktop = document.getElementById(
                        'holiday-overlay-desktop-{{ $item->id }}');
                    if (overlayDesktop) {
                        overlayDesktop.style.transition = 'opacity 0.5s ease';
                        overlayDesktop.style.opacity = '0';
                        setTimeout(() => overlayDesktop.style.display = 'none', 500);
                    }
                }, duration);

                // Mobile Auto Hide per item
                setTimeout(() => {
                    const overlayMobile = document.getElementById(
                        'holiday-overlay-mobile-{{ $item->id }}');
                    const containerMobile = document.getElementById(
                        'holiday-container-mobile-{{ $item->id }}');
                    if (overlayMobile) {
                        overlayMobile.style.transition = 'opacity 0.5s ease';
                        overlayMobile.style.opacity = '0';
                        setTimeout(() => {
                            overlayMobile.style.display = 'none';
                            if (containerMobile) containerMobile.style.display = 'none';
                        }, 500);
                    }
                }, duration);
            });
        @empty
        @endforelse
    </script>
@endsection
