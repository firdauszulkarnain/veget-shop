<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use Illuminate\Database\Seeder;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kabupaten::create([
            'nama_kab' => 'DENPASAR'
        ]);
        Kabupaten::create([
            'nama_kab' => 'JEMBRANA'
        ]);
        Kabupaten::create([
            'nama_kab' => 'TABANAN'
        ]);
        Kabupaten::create([
            'nama_kab' => 'BADUNG'
        ]);
        Kabupaten::create([
            'nama_kab' => 'GIANYAR'
        ]);
        Kabupaten::create([
            'nama_kab' => 'KLUNGKUNG'
        ]);
        Kabupaten::create([
            'nama_kab' => 'BANGLI'
        ]);
        Kabupaten::create([
            'nama_kab' => 'KARANGASEM'
        ]);
        Kabupaten::create([
            'nama_kab' => 'BULELENG'
        ]);
    }
}
