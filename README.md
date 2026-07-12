# SIPATAN — Sistem Pakar Diagnosa Penyakit & Hama Bawang Merah

---

### 📝 IDENTITAS MAHASISWA & PKL
* **Nama**: Veri Ajie Saputra
* **NIM**: 23215017
* **Tempat PKL**: Dinas Pertanian dan Ketahanan Pangan (DPKP) Kabupaten Brebes
* **Judul Sistem**: SIPATAN — Sistem Pakar Diagnosa Penyakit & Hama Bawang Merah berbasis Certainty Factor (CF)
* **Tautan/Link Deploy**: -

---

SIPATAN adalah aplikasi Sistem Pakar (Expert System) berbasis Certainty Factor (CF) yang dirancang khusus untuk membantu petani dan penyuluh pertanian dalam mendiagnosis penyakit dan hama pada komoditas **Bawang Merah** di Kabupaten Brebes.

## Desain Premium & Estetika
Aplikasi ini hadir dengan desain antarmuka modern yang responsif dan memukau:
- **Google Fonts Pairing**: Menggunakan font **Outfit** untuk heading/judul (memberi kesan profesional dan tegas) dan **Plus Jakarta Sans** untuk teks tubuh (sangat nyaman dibaca).
- **Skema Warna Red Onion**: Gradasi dan aksen warna ungu-merah segar khas bawang merah Brebes untuk komponen interaktif, tombol, dan visualisasi data.
- **Halaman Login Split-Screen**: Desain masuk akun modern dengan layout belah-layar, menampilkan keindahan visual lahan pertanian bawang merah di satu sisi dan formulir autentikasi bersih di sisi lainnya.
- **Panel Dashboard Gelap Modern**: Sidebar bernuansa gelap dengan efek hover gradasi yang menyala dan dinamis.

## Fitur Utama
- **Diagnosa Interaktif (CF)**: Alur diagnosa adaptif dengan memilih gejala klinis dan mengatur tingkat keyakinan (6 skala dari "Tidak Yakin" hingga "Sangat Yakin").
- **Manajemen Basis Pengetahuan**: CRUD data Gejala, Penyakit, Hama, dan aturan Rule (beserta pembobotan CF pakar) yang dinamis.
- **Dashboard Tren Analitik**: Grafik visualisasi interaktif pergerakan tren deteksi dan sebaran aturan pakar per penyakit/hama.
- **Tanpa Login**: Petani dapat melakukan diagnosa instan kapan saja tanpa wajib memiliki akun.

## Teknologi
- **Laravel 11** & PHP 8.3
- **Blade Template** (Layout inheritance + components)
- **Bootstrap 5** (Kustomisasi lokal tanpa CDN)
- **ApexCharts** (Grafik analitik tren dan distribusi)
- **MySQL / MariaDB**

## Struktur Direktori Penting
```
app/
├── Http/
│   ├── Controllers/Admin/   # Dashboard, Gejala, Penyakit, Hama, Rule, User
│   ├── Controllers/         # Diagnosis, Landing, Riwayat, Profile
│   ├── Middleware/          # RoleMiddleware
│   └── Requests/            # Form request validation
└── Models/                  # Gejala, Penyakit, Hama, RiwayatDeteksi, Rule, RuleDetail, User

public/assets/               # Aset kustom CSS, JS, fonts, dan gambar pertanian
resources/views/
├── template_backend/        # Layout dashboard & partials (navbar, sidebar, footer)
├── components/              # Komponen reusable (page-header, stat-card, dll)
├── admin/                   # CRUD admin panel
├── auth/                    # Halaman login/register (Bootstrap split-screen)
└── landing/                 # Landing page & sub-halaman publik
```

## Panduan Instalasi
1. Clone repositori ini.
2. Install dependensi composer:
   ```bash
   composer install
   ```
3. Salin file environment:
   ```bash
   cp .env.example .env
   ```
4. Generate key aplikasi:
   ```bash
   php artisan key:generate
   ```
5. Konfigurasi database di `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sistem_pakar_bawang
   DB_USERNAME=root
   DB_PASSWORD=
   DB_CHARSET=utf8mb4
   DB_COLLATION=utf8mb4_unicode_ci
   ```
   > **Catatan**: MariaDB bawaan Laragon/XAMPP disarankan menggunakan `DB_COLLATION=utf8mb4_unicode_ci`.
6. Migrasi database beserta seeders basis pengetahuan bawang merah:
   ```bash
   php artisan migrate:fresh --seed
   ```
7. Jalankan server lokal:
   ```bash
   php artisan serve
   ```
   Akses aplikasi melalui `http://127.0.0.1:8000`.

## Akun Demo Default
| Role     | Email                   | Password   |
| -------- | ----------------------- | ---------- |
| Admin    | `admin@sipatan.test`    | `password` |
| Petugas  | `petugas@sipatan.test`  | `password` |
