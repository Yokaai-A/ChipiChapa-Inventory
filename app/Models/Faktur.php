<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faktur extends Model
{
    protected $fillable = ['user_id', 'nomor_invoice', 'alamat_pengiriman', 'kode_pos', 'total_harga'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailFakturs()
    {
        return $this->hasMany(DetailFaktur::class, 'faktur_id');
    }
}
