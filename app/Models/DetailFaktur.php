<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailFaktur extends Model
{
    protected $fillable = ['faktur_id', 'product_id', 'kuantitas', 'subtotal'];

    public function faktur()
    {
        return $this->belongsTo(Faktur::class, 'faktur_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
