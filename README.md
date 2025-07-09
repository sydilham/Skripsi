<<<<<<< HEAD
# Sistem Informasi Laporan Pajak Penghasilan

## 📌 Deskripsi

Sistem Informasi Laporan Pajak Penghasilan adalah aplikasi berbasis web yang digunakan untuk mengelola data pajak karyawan klien di kantor konsultan pajak. Aplikasi ini membantu dalam pembuatan laporan pajak yang dapat dicetak sesuai kebutuhan.

## 🚀 Fitur Utama

1. **Dashboard**: Menampilkan ringkasan jumlah perusahaan, karyawan, dan total pajak yang dipotong.
2. **Manajemen Perusahaan Klien**: Menambah, mengedit, dan menghapus data perusahaan klien.
3. **Manajemen Karyawan Klien**: Mengelola data karyawan dari perusahaan klien.
4. **Jenis Pajak**: Mengelola daftar jenis pajak yang berlaku seperti PPh 21 dan PPh 23.
5. **Laporan Pajak**: Melihat dan mencetak laporan pajak dengan detail penghasilan dan potongan pajak.
6. **Autentikasi**: Sistem login menggunakan Laravel Breeze.
7. **Cetak Laporan**: Dukungan ekspor laporan dalam format PDF menggunakan DomPDF.

## 🛠️ Teknologi yang Digunakan

-   **Laravel 11** - Framework utama untuk backend.
-   **Laravel Breeze** - Autentikasi sederhana.
-   **Yajra DataTables** - Pengelolaan tabel data.
-   **Tailwind CSS** - Styling frontend.
-   **DomPDF** - Konversi laporan pajak ke format PDF.

## 🏗️ Instalasi

### 1. Clone Repository

```sh
git clone https://github.com/andrnnnn/app-laporan-pajak-laravel.git
cd repository
```

### 2. Install Dependencies

```sh
composer install
npm install && npm run dev
```

### 3. Konfigurasi Database

Buat file `.env` dan atur konfigurasi database:

```sh
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dengan kredensial database yang sesuai.

### 4. Jalankan Migrasi

```sh
php artisan migrate --seed
```

### 5. Enkripsi File `.env`

```sh
php artisan env:encrypt
```

Pastikan untuk menyimpan encryption key yang dihasilkan.

### 6. Jalankan Server

```sh
php artisan serve
```

Akses aplikasi di `http://127.0.0.1:8000`.

## 🔐 Penyimpanan `.env` yang Aman

File `.env` telah dienkripsi menggunakan `AES-256-CBC`. Pastikan encryption key berikut disimpan dengan aman:

```sh
base64:hJBJm/ozR59gh1XWosoP9jY96p2GdPzuWpXrclPCdWU=
```

Gunakan perintah berikut untuk mendekripsi:

```sh
php artisan env:decrypt
```
=======
# Skripsi
Rancang Bangun Sistem Penghitungan Dan Pelaporan Pajak Berbasis Website Di SDN CARINGIN I
>>>>>>> b918662294e52a2a9a8a95186892bf6bbc54a0df
