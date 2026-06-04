

## Sabtu, 23 Mei 2026

## Permintaan:
- Penambahan  fitur  notifikasi  hari-hari  penting  atau  tanggal  merah  pada  halaman
utama (homepage) kamus. Jika terdapat peringatan hari besar, seperti Hari Raya Idul
Fitri, maka sistem akan menampilkan ikon atau animasi tertentu, seperti ikon ketupat,
pada  halaman  utama.  Pengaturan  fitur  ini  dikelola  melalui  akun  admin,  sehingga
admin dapat menentukan tanggal tampil, jenis ikon, serta durasi penampilannya. Ikon
atau animasi tersebut akan otomatis hilang setelah 5 detik sejak halaman diakses oleh
pengguna.
- Penambahan 1 game yaitu WORD SCRAMBLE (acak huruf menjadi kata), contoh
game seperti ini: https://playscrabble.com/
- Level game dibagi 3 level
o Level 1 Beginner (Dasar)
o Level 2 Intermediate (Menengah)
o Level 3 Advanced (Lanjutan)
Catatan: Sistem   level   pemain   menggunakan   mekanisme   unlock
berdasarkan target tertentu yang ditetapkan oleh admin.

Pemain dapat naik ke level berikutnya jika memenuhi salah satu atau
seluruh syarat berikut:
-Menyelesaikan seluruh game pada level saat ini.
-Memenuhi target khusus yang telah ditentukan admin.

Contoh implementasi:
-Pada Level 1, admin menetapkan total 20 game.
-Pemain  harus  menyelesaikan  seluruh  game  tersebut  dengan  benar
untuk membuka akses ke Level 2.
-Setelah syarat Level 1 terpenuhi, maka Level 2 akan otomatis terbuka.
-Mekanisme yang sama berlaku untuk level-level berikutnya.

## • Pop Up Detail
Misalnya, jika user berhasil menyusun huruf menjadi kata “BANANA”, maka
sistem akan menampilkan pop up atau kotak informasi yang berisi penjelasan
mengenai kata “BANANA”. Isi deskripsi atau penjelasan pada pop up tersebut
dikelola  oleh  admin,  sehingga  admin  dapat menambahkan,  mengubah,  atau
menghapus informasi sesuai kebutuhan.
- Background menggunakan gambar atau foto bertema wetland (lahan basah)
sebagai  latar  belakang  permainan SCRAMBLE.  Pengaturan  dan  pengelolaan
background   dilakukan   melalui   halaman   admin,   sehingga   admin   dapat
menambahkan, mengubah, atau mengganti background sesuai kebutuhan.

- Background musik akan diputar secara otomatis saat permainan dimulai untuk
menambah  pengalaman  bermain  pengguna.  Pengaturan  dan  pengelolaan
musik     dilakukan     melalui     halaman     admin,     sehingga     admin     dapat
menambahkan, mengubah, atau mengganti musik sesuai kebutuhan.
- Permainan memiliki 3 jenis mode permainan, yaitu:
o User vs Komputer, yaitu permainan antara pengguna dan komputer. Jika
pengguna  menjawab  salah,  maka  giliran  bermain  akan  berpindah  ke
komputer. Namun, jika jawaban benar, maka giliran tetap dilanjutkan oleh
pengguna.
o User vs User, yaitu permainan antara dua pengguna. Jika pemain pertama
menjawab salah, maka giliran bermain akan berpindah ke pemain kedua.
Namun,  jika  jawaban  benar,  maka  giliran  tetap  dilanjutkan  oleh  pemain
pertama.
o Multiplayer,   yaitu   permainan   yang   dapat   dimainkan   oleh   banyak
pengguna   sekaligus   dan   dilengkapi   dengan   fitur   leaderboard   untuk
menampilkan peringkat pemain berdasarkan skor yang diperoleh.

Setiap mode permainan memiliki batas waktu (timer) yang ditentukan untuk
setiap  sesi  atau  pertanyaan.  Seluruh  pengaturan  permainan,  seperti  jenis
mode,   timer,   leaderboard,   dan   mekanisme   permainan,   dikelola   melalui
halaman   admin   sehingga   admin   dapat   menambahkan,   mengubah,   atau
menyesuaikan pengaturan sesuai kebutuhan.

## BUG:
- Admin tidak bisa masuk ke halaman log in
- Web sering muncul 404
Revisi dari sebelumnya yang belum sempat (dan hasil dari saran pengguna)
- Mungkin  fitur  jawaban  nya  yang  benar  itu  bisa  dicantumkan,  dan  kita  dapat
mengetahui jawaban yang benarnya bila ada kesalahan dalam menjawab sebuah
soal
- Fitur history? Saya tidak yakin sudah ada atau belum, soalnya kadang² saya keluar
secara  tiba-tiba  karena  jaringan  dadi  web  dan  saya  tidak  bisa  melihat  nilai  saya,
mungkin dengan ditambah fitur ini saya bisa cek history nilai saya dikuis yg saya
kerjakan.
- Iya,  karena  sebenarnya  sudah  baik  tapi  bisa  ditambahkan  fitur  hiasan  agar  lebih
syantik dan menarik
- Bagan nomor pertanyaan kuis yang sudah dan belum terjawab yang dapat terlihat.
- Mungkin petunjuk  dimana  kita  bisa  melihat  hasil  skor  setelah  selesai  menjawab
kuis
- Tambahkan foto kata kata motivasi seperti di website way gorund

- Fitur leaderboard yg lebih jelas
- Mungkin petunjuk  dimana  kita  bisa  melihat  hasil  skor  setelah  selesai  menjawab
kuis
- Tentang penilaiannya aja sie, kasih skor