# SIMASTOK — Sistem Manajemen Stok Barang UMKM

Aplikasi web untuk mengelola stok barang: kategori, data barang, dan transaksi stok masuk/keluar,
dengan autentikasi dan dua peran pengguna (Admin & Staff). Dibangun dengan Laravel 11 (PHP) + Blade + Tailwind CSS (CDN).

## Fitur
- Login & Register (Laravel Auth session-based, tanpa Breeze/Jetstream — ditulis manual)
- Role-based access: **Admin** (kelola kategori, kelola barang, kelola transaksi) & **Staff** (lihat barang, catat transaksi stok)
- CRUD Kategori Barang
- CRUD Data Barang (SKU, harga, stok, stok minimum)
- Transaksi Stok Masuk/Keluar (otomatis update jumlah stok, cek stok cukup untuk transaksi keluar)
- Dashboard: ringkasan total barang, total stok, peringatan stok menipis, transaksi terbaru
- Pencarian & filter data barang dan transaksi

## Cara Menjalankan (Local)

1. **Clone / salin folder project ini**, lalu masuk ke foldernya.

2. **Install dependency PHP** (butuh Composer & PHP >= 8.2):
   ```bash
   composer install
   ```

3. **Copy file environment & generate key**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup database (default: SQLite, paling gampang)**:
   ```bash
   touch database/database.sqlite
   php artisan migrate --seed
   ```
   Jika ingin pakai MySQL, ubah `DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, dll di file `.env`.

5. **Jalankan server**:
   ```bash
   php artisan serve
   ```
   Buka `http://127.0.0.1:8000` di browser.

## Akun Demo (hasil seeder)
| Role  | Email                | Password |
|-------|-----------------------|----------|
| Admin | admin@simastok.test  | password |
| Staff | staff@simastok.test  | password |

## Struktur Database
- `users` (+ kolom `role`: admin/staff)
- `categories`
- `items` (relasi ke `categories`)
- `stock_transactions` (relasi ke `items` dan `users`)

## Deployment
Aplikasi ini bisa dideploy ke Railway / Render / Hostinger / shared hosting yang mendukung PHP & Composer.
Pastikan set environment variable sesuai `.env.example` dan jalankan `php artisan migrate --seed` setelah deploy.

## Catatan Pengembangan dengan AI
Struktur aplikasi ini (migration, model, controller, route, view) dibuat dengan bantuan AI (Claude) sebagai alat bantu
percepatan penulisan kode, mengikuti rancangan pada dokumen PRD terlampir. Sebelum submit, pastikan kamu:
1. Menjalankan aplikasi secara lokal dan mengujinya sendiri.
2. Memahami alur tiap fitur (baca controller & route-nya).
3. Menyesuaikan tema/nama/branding jika ingin dibuat lebih personal.
4. Merekam video presentasi sesuai instruksi UAS (termasuk bagian refleksi penggunaan AI).
