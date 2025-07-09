# Skripsi
Rancang Bangun Sistem Penghitungan Dan Pelaporan Pajak Berbasis Website Di SDN CARINGIN I

## 📌 Deskripsi

Sistem Penghitungan dan pelaporan dokumen pajak mempermudah dalam proses menghitung dan mengupload bukti bukti pajak di dunia pendidikan.

## 🚀 Fitur Utama

1. **Dashboard**
2. **Jenis Pajak**
3. **Laporan Pajak**
4. **Autentikasi**
5. **Cetak Laporan** 

## 🛠️ Teknologi yang Digunakan

-   **Laravel 11** - Framework utama untuk backend.
-   **Laravel Breeze** - Autentikasi sederhana.
-   **Yajra DataTables** - Pengelolaan tabel data.
-   **Tailwind CSS** - Styling frontend.
-   **DomPDF** - Konversi laporan pajak ke format PDF.

## 🏗️ Instalasi

### 1. Clone Repository

```sh
git clone https://github.com/sydilham/app-laporan-pajak-laravel.git
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


