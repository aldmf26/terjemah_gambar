# Rencana Implementasi: 2 Mode Permainan Word Scramble (Fase 5)

Rencana ini menjelaskan alur logika dan implementasi teknis untuk mode **Pemain vs Komputer** dan **Pemain vs Pemain (Lokal)**. Mode Multiplayer ditunda terlebih dahulu.

## Alur Logika Permainan

```mermaid
flowchart TD
    Start([Mulai Permainan]) --> ModeSel{Pilih Mode}
    
    ModeSel -->|vs Komputer| TurnUser[Giliran User]
    TurnUser --> UserAns{Jawaban User?}
    UserAns -->|Benar| UserScore[Skor User +1] --> NextWord1[Lanjut Kata Baru] --> TurnUser
    UserAns -->|Salah / Waktu Habis| TurnComp[Giliran Komputer]
    TurnComp --> Delay[Jeda 2 Detik] --> CompRoll{Akurasi Acak 50%}
    CompRoll -->|Benar| CompWin[Komputer Benar] --> ShowAns1[Tampil Pop-up Penjelasan] --> NextWord2[Lanjut Kata Baru] --> TurnUser
    CompRoll -->|Salah| CompLose[Komputer Salah] --> TurnUser
    
    ModeSel -->|vs User / Lokal| TurnP1[Giliran Pemain 1]
    TurnP1 --> P1Ans{Jawaban P1?}
    P1Ans -->|Benar| P1Score[Skor P1 +1] --> NextWord3[Lanjut Kata Baru] --> TurnP1
    P1Ans -->|Salah / Waktu Habis| TurnP2[Giliran Pemain 2]
    TurnP2 --> P2Ans{Jawaban P2?}
    P2Ans -->|Benar| P2Score[Skor P2 +1] --> NextWord4[Lanjut Kata Baru] --> TurnP2
    P2Ans -->|Salah / Waktu Habis| TurnP1
```

---

## Proposed Changes

### Word Scramble Gameplay Component (Livewire)

#### [MODIFY] [ScramblePlay.php](file:///c:/laragon/www/terjemah_gambar/app/Http/Livewire/ScramblePlay.php)
- State variable baru:
  - `$gameMode`: `'vs_computer'` atau `'vs_user'`.
  - `$currentTurn`: `'user'`, `'computer'`, `'player1'`, atau `'player2'`.
  - `$player1Score` & `$player2Score` (untuk mode `vs_user`).
  - `$computerScore` (untuk mode `vs_computer`).
- Method `computerTurn()`:
  - Dipicu secara otomatis setelah jeda 2 detik jika giliran berpindah ke komputer.
  - Komputer menjawab secara acak (akurasi 50%). Jika benar, komputer mendapatkan poin dan lanjut ke kata baru. Jika salah, giliran dikembalikan ke user pada kata yang sama.
- Menyesuaikan method `submitAnswer()`:
  - Validasi berdasarkan mode permainan dan ganti giliran jika jawaban salah.

#### [MODIFY] [scramble-play.blade.php](file:///c:/laragon/www/terjemah_gambar/resources/views/livewire/scramble-play.blade.php)
- Halaman pilihan Mode (vs Komputer atau vs User Lokal) sebelum memulai game.
- Papan indikator status giliran yang aktif ("Giliran: Pemain 2" atau "Komputer sedang menjawab...").
- Tampilan skor masing-masing pihak secara real-time.

## Verification Plan

### Manual Verification
- Uji coba mode **vs Komputer**: Jawab salah secara sengaja, pastikan giliran berpindah ke komputer, ada jeda 2 detik, dan komputer menjawab secara otomatis.
- Uji coba mode **vs User**: Mainkan dua orang secara bergantian, pastikan giliran berpindah dari Pemain 1 ke Pemain 2 saat salah menjawab.
