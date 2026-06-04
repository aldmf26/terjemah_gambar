# Daftar Tugas (TODO List) Projek Terjemah Gambar

## Fase 1: Hotfix Bug Utama (Login & 404)
- [ ] Edit [RedirectIfAuthenticated.php](file:///C:/laragon/www/terjemah_gambar/app/Http/Middleware/RedirectIfAuthenticated.php) untuk menghapus `dd($role);`
- [ ] Periksa dan rapikan rute web di [web.php](file:///C:/laragon/www/terjemah_gambar/routes/web.php) agar terlindung auth middleware.
- [ ] Tes login admin dengan `admin@gmail.com` dan user dengan `user@gmail.com`.

## Fase 2: Notifikasi Hari Besar
- [ ] Buat migrasi tabel `holiday_notifications`.
- [ ] Buat model `HolidayNotification.php`.
- [ ] Buat controller CRUD `HolidayNotificationController.php` beserta rutenya.
- [ ] Buat halaman view pengelolaan notifikasi admin.
- [ ] Integrasikan notifikasi pada homepage [welcome.blade.php](file:///C:/laragon/www/terjemah_gambar/resources/views/welcome.blade.php) menggunakan overlay ikon & javascript auto-hide 5 detik.

## Fase 3: Database & Model Game Word Scramble
- [ ] Buat migrasi tabel `scramble_words` untuk kata, deskripsi pop-up, dan level.
- [ ] Buat migrasi tabel `scramble_settings` untuk background wetland, backsound musik, timer, dan unlock target.
- [ ] Buat migrasi tabel `scramble_attempts` untuk melacak skor kuis scramble.
- [ ] Jalankan perintah `php artisan migrate` untuk mengaplikasikan migrasi baru.
- [ ] Buat model-model Laravel terkait: `ScrambleWord`, `ScrambleSetting`, dan `ScrambleAttempt`.

## Fase 4: Pengelolaan Admin Word Scramble
- [ ] Buat controller `ScrambleController.php` untuk CRUD kata, setting, dan upload media.
- [ ] Daftarkan rute admin scramble di [web.php](file:///C:/laragon/www/terjemah_gambar/routes/web.php).
- [ ] Buat tampilan web admin untuk kelola kata & upload musik/background.

## Fase 5: Modul Game Word Scramble (Livewire)
- [ ] Buat komponen Livewire `ScramblePlay.php` untuk memuat engine game.
- [ ] Implementasikan fungsi pengacakan kata (scrambling) dan validasi input.
- [ ] Implementasikan alur bermain 3 mode (vs Komputer, vs User, dan Multiplayer).
- [ ] Tambahkan logika unlock level otomatis berdasarkan data pengerjaan sebelumnya.
- [ ] Tambahkan pemutaran backsound musik otomatis dan pemuatan background wetland dinamis.
- [ ] Integrasikan pop-up detail penjelasan kata saat jawaban user benar.
- [ ] Buat tampilan view `scramble-play.blade.php` dengan desain glassmorphism modern.

## Fase 6: Peningkatan UI & Revisi Kuis Lama
- [ ] Tambahkan bagan grid nomor kuis yang interaktif di [quizplay.blade.php](file:///C:/laragon/www/terjemah_gambar/resources/views/livewire/quizplay.blade.php).
- [ ] Implementasikan tampilan jawaban yang benar secara langsung saat user salah menjawab.
- [ ] Tambahkan kata-kata motivasi estetik di [dashboard_user.blade.php](file:///C:/laragon/www/terjemah_gambar/resources/views/participant/dashboard_user.blade.php) beserta pembenahan visual leaderboard.
- [ ] Percantik riwayat nilai peserta kuis agar lebih informatif.

## Fase 7: Uji Coba & Demo
- [ ] Verifikasi keseluruhan fungsi game Word Scramble.
- [ ] Tes respon tampilan responsive di mobile/desktop.
- [ ] Pastikan tidak ada lagi bug 404 saat perpindahan kuis.
