<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'nama_barang', 'harga_barang', 'jumlah_barang', 'foto_barang'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
