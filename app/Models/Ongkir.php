<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kabupaten()
    {
        return $this->hasOne(Kabupaten::class, 'id', 'kab_id');
    }

    public function kecamatan()
    {
        return $this->hasOne(Kecamatan::class, 'id', 'kec_id');
    }

    public function store()
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }
}
