# 📦 ChipiChapa Inventory

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev/)

**ChipiChapa Inventory** adalah aplikasi web inventaris dan titik penjualan (POS) sederhana berbasis web. Platform ini memudahkan pengelolaan produk dan kategori bagi admin, serta menyediakan antarmuka katalog, keranjang belanja, dan cetak invoice untuk pengguna.

---

## ✨ Fitur Utama

- 🔐 **Autentikasi & Otorisasi:** Sistem registrasi dan login dengan pembagian peran (Admin vs User).
- 🛠️ **Manajemen Inventaris (Admin):** Kelola data produk, kontrol stok, dan kategori barang secara fleksibel.
- 🛒 **Katalog & Keranjang Interaktif:** Penelusuran produk dengan validasi stok *real-time* berbasis session.
- 📄 **Checkout & Invoice:** Pembuatan transaksi otomatis lengkap dengan tampilan faktur/invoice siap cetak.

---

## 🛠️ Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Frontend:** Blade Templating, Tailwind CSS, Vite
- **Database:** SQLite (default) / MySQL
- **Package Manager:** Composer, Node.js & npm

---

## 🚀 Panduan Memulai

### Prasyarat
Pastikan sistem Anda sudah terpasang:
- **PHP 8.2+** (dengan ekstensi `pdo_sqlite` aktif untuk SQLite)
- **Composer**
- **Node.js & npm**

---

### 1. 📥 Instalasi & Konfigurasi

Jalankan perintah berikut di terminal Anda:

```bash
# Clone dan masuk ke direktori proyek
git clone https://github.com/username/chipichapa-inventory.git
cd chipichapa-inventory

# Instalasi dependensi PHP & Node
composer install
npm install

# Konfigurasi file environment
cp .env.example .env

# Buat database SQLite bawaan
touch database/database.sqlite

# Generate Application Key & Migrasi Database
php artisan key:generate
php artisan migrate --seed
```

> 💡 **Tips:** Opsi `--seed` akan memasukkan akun demo, kategori, dan contoh produk. Jika menginginkan database kosong, jalankan `php artisan migrate` tanpa `--seed`.

---

### 2. 🗄️ Menggunakan MySQL (Opsional)

Jika ingin menggunakan MySQL alih-alih SQLite, sesuaikan konfigurasi file `.env` sebelum melakukan migrasi:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_kamu
DB_USERNAME=root
DB_PASSWORD=
```

Setelah database MySQL dibuat, jalankan migrasi:
```bash
php artisan migrate --seed
```

---

## 🏃‍♂️ Menjalankan Aplikasi

Buka dua jendela terminal dari direktori proyek:

1. **Terminal 1 (Laravel Server):**
   ```bash
   php artisan serve
   ```
2. **Terminal 2 (Vite Server):**
   ```bash
   npm run dev
   ```

Akses aplikasi melalui browser Anda pada alamat **`http://127.0.0.1:8000`**.

---

## 🔑 Akun Demo (Testing)

Setelah menjalankan `--seed`, Anda dapat mencoba aplikasi dengan kredensial berikut:

| Peran | Email | Password |
| :---: | :--- | :--- |
| **Admin** | `admin@gmail.com` | `password123` |
| **User** | `budi@gmail.com` | `password123` |
| **User** | `andi@gmail.com` | `password123` |

> ⚠️ **Catatan Keamanan:** Akun di atas diperuntukkan khusus untuk pengujian lokal. Ganti atau hapus kredensial sebelum dideploy ke lingkungan produksi.

---

## 🧰 Perintah Berguna

```bash
php artisan migrate       # Menjalankan migrasi struktur database
php artisan db:seed       # Memasukkan data awal/demo ke database
npm run build             # Melakukan kompilasi aset frontend untuk produksi
```

---

<p align="center">Made with ❤️</p>