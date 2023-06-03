<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detpesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function pesanan()
    {
        return $this->hasOne(Pesanan::class, 'id', 'pesanan_id');
    }

    public function produk()
    {
        return $this->hasOne(Produk::class, 'id', 'produk_id');
    }

    public function store()
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }
}
