<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1 Admin
        User::create([
            'nama_lengkap' => 'Pak Raja',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'admin_id' => 'ADM-001',
            'no_hp' => '081234567890'
        ]);

        // Beberapa User biasa
        User::create([
            'nama_lengkap' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
            'no_hp' => '089876543210'
        ]);

        User::create([
            'nama_lengkap' => 'Andi Wijaya',
            'email' => 'andi@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
            'no_hp' => '081122334455'
        ]);

        // Beberapa Kategori
        $kategoriElektronik = Category::create(['nama_kategori' => 'Elektronik']);
        $kategoriPakaian = Category::create(['nama_kategori' => 'Pakaian']);
        $kategoriMakanan = Category::create(['nama_kategori' => 'Makanan']);

        // Beberapa Produk
        Product::create([
            'category_id' => $kategoriElektronik->id,
            'nama_barang' => 'Laptop Asus ROG',
            'harga_barang' => 15000000,
            'jumlah_barang' => 10,
            'foto_barang' => null
        ]);

        Product::create([
            'category_id' => $kategoriPakaian->id,
            'nama_barang' => 'Kaos Polos Hitam',
            'harga_barang' => 50000,
            'jumlah_barang' => 50,
            'foto_barang' => null
        ]);

        Product::create([
            'category_id' => $kategoriMakanan->id,
            'nama_barang' => 'Indomie Goreng',
            'harga_barang' => 3000,
            'jumlah_barang' => 0, // To test "Barang sudah habis"
            'foto_barang' => null
        ]);
    }
}
