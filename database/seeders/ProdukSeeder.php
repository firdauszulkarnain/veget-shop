<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produk::create([
            'store_id' => 1,
            'nama_produk' => 'bawang bombay',
            'harga_produk' => 50000,
            'stock_produk' => 1,
            'foto_produk' => 'gambar-produk/gambar1.png',
            'desc_produk' => 'bawang bombay',
        ]);

        Produk::create([
            'store_id' => 1,
            'nama_produk' => 'bawang putih',
            'harga_produk' => 40000,
            'stock_produk' => 1,
            'foto_produk' => 'gambar-produk/gambar2.png',
            'desc_produk' => 'bawang putih',
        ]);
        Produk::create([
            'store_id' => 1,
            'nama_produk' => 'bayam hijau',
            'harga_produk' => 15000,
            'stock_produk' => 1,
            'foto_produk' => 'gambar-produk/gambar3.png',
            'desc_produk' => 'bayam hijau',
        ]);
        Produk::create([
            'store_id' => 1,
            'nama_produk' => 'brokoli',
            'harga_produk' => 35000,
            'stock_produk' => 1,
            'foto_produk' => 'gambar-produk/gambar4.png',
            'desc_produk' => 'brokoli',
        ]);
        Produk::create([
            'store_id' => 1,
            'nama_produk' => 'cabe merah besar',
            'harga_produk' => 75000,
            'stock_produk' => 1,
            'foto_produk' => 'gambar-produk/gambar5.png',
            'desc_produk' => 'cabe merah besar',
        ]);
        Produk::create([
            'store_id' => 1,
            'nama_produk' => 'kacang panjang',
            'harga_produk' => 17000,
            'stock_produk' => 1,
            'foto_produk' => 'gambar-produk/gambar6.png',
            'desc_produk' => 'kacang panjang',
        ]);
        Produk::create([
            'store_id' => 1,
            'nama_produk' => 'Kangkung',
            'harga_produk' => 15000,
            'stock_produk' => 1,
            'foto_produk' => 'gambar-produk/gambar7.png',
            'desc_produk' => 'kangkung',
        ]);
        Produk::create([
            'store_id' => 1,
            'nama_produk' => 'Kentang',
            'harga_produk' => 25000,
            'stock_produk' => 1,
            'foto_produk' => 'gambar-produk/gambar8.png',
            'desc_produk' => 'Kentang',
        ]);
        Produk::create([
            'store_id' => 1,
            'nama_produk' => 'sawi hijau',
            'harga_produk' => 15000,
            'stock_produk' => 1,
            'foto_produk' => 'gambar-produk/gambar9.png',
            'desc_produk' => 'sawi hijau',
        ]);
        Produk::create([
            'store_id' => 1,
            'nama_produk' => 'Wortel',
            'harga_produk' => 13000,
            'stock_produk' => 1,
            'foto_produk' => 'gambar-produk/gambar10.png',
            'desc_produk' => 'wortel',
        ]);
    }
}
