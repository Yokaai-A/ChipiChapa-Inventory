# 🛒 ChipiChapa Inventory System

Laravel 9 Inventory Management System untuk manajemen produk, keranjang belanja berbasis session, dan sistem invoice.

---

## 📌 Tech Stack

- Laravel 9
- PHP 8+
- MySQL
- Blade Template
- Tailwind CSS
- Vite

---

## 🚀 Features

### 🧾 Product Management

- Menampilkan daftar produk
- Harga ditampilkan dalam format Rupiah
- Validasi stok produk

### 🛒 Cart System (Session-Based)

- Add to cart
- Update quantity
- Remove item
- Data disimpan menggunakan session Laravel

### 📦 Stock Validation

- Sistem otomatis mengecek stok
- Jika stok = 0 akan muncul pesan:
    > Barang sudah habis, silakan tunggu hingga barang di-restock ulang

### 🧾 Invoice System

- Generate nomor invoice otomatis (format: INV-XXX)
- Perhitungan subtotal dan total harga
- Data tersimpan di tabel fakturs dan detail_fakturs
- Cart otomatis dikosongkan setelah checkout

### 🖨️ Printable Invoice

- Tampilan khusus print
- Layout bersih tanpa navbar/sidebar
- Siap cetak (Ctrl + P)

### 🔐 Authentication & Middleware

- Middleware admin (IsAdmin)
- User non-admin diarahkan ke halaman /catalog

---

## 💰 Price Format

Semua harga produk ditampilkan dalam format:
Rp. 15.000

php
Rp. {{ number_format($harga_barang, 0, ',', '.') }}

---
