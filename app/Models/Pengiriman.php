<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pengirimans';

    public function kabupaten()
    {
        return $this->hasOne(Kabupaten::class, 'id', 'kab_id');
    }

    public function kecamatan()
    {
        return $this->hasOne(Kecamatan::class, 'id', 'kec_id');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
