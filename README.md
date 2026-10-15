# app-kes

Sistem Informasi Manajemen Inventaris Alat Kesehatan Medis (**MediCare Alkes**) berbasis Laravel.

## Fitur Utama
- **Dashboard & Katalog Alat Medis**: Monitoring stok, nilai estimasi aset, dan status kondisi alat.
- **Left Sidebar Navigation**: Navigasi vertikal modern dan responsif dengan filter cepat kategori & status pemeliharaan.
- **CRUD Lengkap**: Tambah, Edit, Hapus, dan Detail spesifikasi alat kesehatan.
- **Pencarian & Filter**: Pencarian multi-kolom (nama, kode, merk, lokasi) serta filter kategori, kondisi, dan lokasi.
- **Upload Foto Alat**: Dukungan unggah gambar alat medis.
- **Multi View Mode**: Tampilan Card Grid & Tabel Data interaktif.

## Instalasi & Menjalankan Proyek
1. Clone repositori:
   ```bash
   git clone https://github.com/ArgaPutra05/app-kes.git
   cd app-kes
   ```
2. Salin environment file:
   ```bash
   copy .env.example .env
   ```
3. Generate key & migrasi database:
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```
4. Jalankan aplikasi:
   ```bash
   php artisan serve
   ```
